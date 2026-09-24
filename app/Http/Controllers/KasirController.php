<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function dashboard()
    {
        return view('kasir.dashboard');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'payment_method' => 'required|in:cash,qris',
            'items' => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {

            $total = 0;
            $items = [];

            foreach ($request->items as $item) {

                $variant = ProductVariant::findOrFail(
                    $item['variant_id']
                );

                if ($variant->status != 1) {
                    throw new \Exception(
                        'Varian ' . $variant->size . ' tidak tersedia.'
                    );
                }

                $quantity = (int) $item['quantity'];

                if ($quantity < 1) {
                    throw new \Exception(
                        'Jumlah produk tidak valid.'
                    );
                }

                if ($quantity > $variant->stock) {
                    throw new \Exception(
                        'Stok ' . $variant->size .
                        ' tidak mencukupi.'
                    );
                }

                $subtotal =
                    $variant->price * $quantity;

                $total += $subtotal;

                $items[] = [
                    'variant' => $variant,
                    'quantity' => $quantity,
                    'price' => $variant->price,
                ];
            }


            /*
             * Buat nomor invoice
             */

            $invoiceNumber =
                'KSR' . now()->format('YmdHis');


            /*
             * Simpan order
             */

           $order = Order::create([

    'user_id' => null,

    'invoice_number' => $invoiceNumber,

    'recipient_name' =>
        $request->customer_name,

    'phone' => null,

    'address' => null,

    'shipping_method' => null,

    'payment_method' =>
        $request->payment_method,

    'total' => $total,

    'payment_status' => 'lunas',

    'status' => 'selesai',

    'order_type' => 'kasir',

    'cashier_id' => Auth::id(),

]);


            /*
             * Simpan detail produk
             */

            foreach ($items as $item) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item['variant']->id,
                    'product_name' => $item['variant']->product->name,
                    'size' => $item['variant']->size,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                /*
                 * Kurangi stok varian
                 */

                $item['variant']->decrement(
                    'stock',
                    $item['quantity']
                );
            }


            DB::commit();


            return response()->json([

                'success' => true,

                'message' =>
                    'Transaksi berhasil disimpan.',

                'invoice' =>
                    $order->invoice_number,

                'total' =>
                    $order->total,

            ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([

                'success' => false,

                'message' => $e->getMessage(),

            ], 422);
        }
    }

    public function history(Request $request)
    {
        $query = Order::with(['items', 'cashier'])
            ->where('order_type', 'kasir')
            ->latest();

        // Pencarian invoice atau nama pelanggan
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', '%' . $search . '%')
                  ->orWhere('recipient_name', 'like', '%' . $search . '%');
            });
        }

        // Filter tanggal
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('kasir.history', compact('orders'));
    }
    public function detail(Order $order)
{
    // Pastikan transaksi memang transaksi Kasir
    if ($order->order_type !== 'kasir') {
        abort(404);
    }

    $order->load([
        'items',
        'cashier'
    ]);

    return view('kasir.detail', compact('order'));
}
}