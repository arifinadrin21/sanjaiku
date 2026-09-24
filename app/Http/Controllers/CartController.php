<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan keranjang
     */
    public function index()
    {
        $cart = Cart::with('items.variant.product')
            ->where('user_id', Auth::id())
            ->first();

        return view('cart.index', compact('cart'));
    }

    /**
     * Tambah ke keranjang
     */
    public function store(Request $request)
{
    $request->validate([
        'product_variant_id' => 'required|exists:product_variants,id',
        'quantity' => 'required|integer|min:1'
    ]);

    // Ambil varian produk
    $variant = \App\Models\ProductVariant::findOrFail(
        $request->product_variant_id
    );

    // Cek apakah varian masih aktif
    if ($variant->status != 1) {
        return back()->with('error', 'Varian produk tidak tersedia.');
    }

    // Cek stok
    if ($variant->stock <= 0) {
        return back()->with('error', 'Stok untuk ukuran ' . $variant->size . ' sudah habis.');
    }

    // Cari atau buat keranjang
    $cart = Cart::firstOrCreate([
        'user_id' => Auth::id()
    ]);

    // Cek apakah varian sudah ada di keranjang
    $item = CartItem::where('cart_id', $cart->id)
        ->where('product_variant_id', $request->product_variant_id)
        ->first();

    // Jumlah yang sudah ada di keranjang
    $currentQuantity = $item ? $item->quantity : 0;

    // Jumlah setelah ditambahkan
    $newQuantity = $currentQuantity + $request->quantity;

    // Jangan melebihi stok
    if ($newQuantity > $variant->stock) {
        return back()->with(
            'error',
            'Jumlah pesanan melebihi stok. Stok ukuran ' .
            $variant->size .
            ' hanya tersedia ' .
            $variant->stock .
            ' pcs.'
        );
    }

    if ($item) {

        $item->update([
            'quantity' => $newQuantity
        ]);

    } else {

        CartItem::create([
            'cart_id' => $cart->id,
            'product_variant_id' => $request->product_variant_id,
            'quantity' => $request->quantity
        ]);

    }

    return redirect()
        ->route('cart.index')
        ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}

    /**
     * Hapus item keranjang
     */
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}