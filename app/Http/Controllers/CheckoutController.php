<?php

namespace App\Http\Controllers;



use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher;
use App\Models\VoucherRedemption;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.variant.product')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|max:100',
            'phone' => 'required|max:20',
            'address' => 'required',
            'payment_method' => 'required|in:midtrans',
            'voucher_code' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $cart = Cart::with('items.variant.product')
                ->where('user_id', Auth::id())
                ->first();

            if (!$cart || $cart->items->count() == 0) {
                DB::rollBack();
                return redirect()->route('cart.index')
                    ->with('error', 'Keranjang kosong.');
            }

            // ===========================
            // HITUNG SUBTOTAL
            // ===========================
            $subtotal = 0;

            foreach ($cart->items as $item) {
                $subtotal += $item->variant->price * $item->quantity;
            }

            // ===========================
            // VOUCHER
            // ===========================
            $discount = 0;
            $voucher = null;

            if ($request->filled('voucher_code')) {

                $voucher = Voucher::where('code', $request->voucher_code)
                    ->where('status', 1)
                    ->first();

                if (!$voucher) {
                    DB::rollBack();
                    return back()->with('error', 'Kode voucher tidak ditemukan.');
                }

                if (today()->lt($voucher->start_date)) {
                    DB::rollBack();
                    return back()->with('error', 'Voucher belum berlaku.');
                }

                if (today()->gt($voucher->expired_date)) {
                    DB::rollBack();
                    return back()->with('error', 'Voucher sudah kedaluwarsa.');
                }

                if ($voucher->used >= $voucher->quota) {
                    DB::rollBack();
                    return back()->with('error', 'Kuota voucher telah habis.');
                }

                if ($subtotal < $voucher->minimum_purchase) {
                    DB::rollBack();
                    return back()->with(
                        'error',
                        'Minimal pembelian Rp ' .
                        number_format($voucher->minimum_purchase, 0, ',', '.')
                    );
                }

                if ($voucher->type == 'nominal') {
                    $discount = $voucher->discount_amount;
                } else {
                    $discount = ($subtotal * $voucher->discount_amount) / 100;
                }

                // Jangan sampai diskon lebih besar dari subtotal
                if ($discount > $subtotal) {
                    $discount = $subtotal;
                }
            }

            $total = $subtotal - $discount;

        // ===========================
        // KONFIGURASI MIDTRANS
        // ===========================
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

            // ===========================
            // SIMPAN ORDER
            // ===========================
            $order = Order::create([
    'invoice_number' => 'INV' . date('YmdHis'),
    'user_id' => Auth::id(),
    'recipient_name' => $request->recipient_name,
    'phone' => $request->phone,
    'address' => $request->address,
    'payment_method' => $request->payment_method,
    'payment_status' => 'belum_bayar',
    'payment_proof' => null,
    'subtotal' => $subtotal,
    'shipping_cost' => 0,
    'discount' => $discount,
    'total' => $total,
    'earned_points' => 0,
    'status' => 'pending',
]);

            // ===========================
// PARAMETER MIDTRANS
// ===========================
$params = [
    'transaction_details' => [
        'order_id' => $order->invoice_number,
        'gross_amount' => (int) $order->total,
    ],

    'customer_details' => [
        'first_name' => $order->recipient_name,
        'phone' => $order->phone,
        'billing_address' => [
            'address' => $order->address,
        ],
    ],
];

// ===========================
// BUAT SNAP TOKEN MIDTRANS
// ===========================
$snapToken = Snap::getSnapToken($params);

$order->update([
    'snap_token' => $snapToken,
]);



            // ===========================
            // SIMPAN ORDER ITEMS
            // ===========================
            foreach ($cart->items as $item) {

                OrderItem::create([
                    'order_id'            => $order->id,
                    'product_variant_id'  => $item->product_variant_id,
                    'product_name'        => $item->variant->product->name,
                    'size'                => $item->variant->size,
                    'price'               => $item->variant->price,
                    'quantity'            => $item->quantity,
                    'point'               => $item->variant->point,
                    'subtotal'            => $item->variant->price * $item->quantity,
                ]);

                $variant = $item->variant;
                $variant->stock -= $item->quantity;
                $variant->save();
            }

            // ===========================
            // SIMPAN RIWAYAT VOUCHER
            // ===========================
            if ($voucher) {

                VoucherRedemption::create([
                    'user_id'   => Auth::id(),
                    'voucher_id'=> $voucher->id,
                    'order_id'  => $order->id,
                    'status'    => 'digunakan',
                    'used_at'   => now(),
                ]);

                $voucher->increment('used');
            }

            // ===========================
            // HAPUS KERANJANG
            // ===========================
            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            return redirect()
    ->route('payment.midtrans', $order->id);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function qris(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        return view('checkout.qris', compact('order'));
    }

    public function uploadProof(Request $request, Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('payment_proof');

        $filename = time() . '_' . $file->getClientOriginalName();

        $file->storeAs('payment_proofs', $filename, 'public');

        $order->update([
            'payment_proof'  => $filename,
            'payment_status' => 'menunggu_verifikasi',
        ]);

        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', 'Bukti pembayaran berhasil dikirim.');
    }
}