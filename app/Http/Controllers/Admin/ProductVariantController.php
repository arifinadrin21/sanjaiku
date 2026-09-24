<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Menampilkan semua varian produk di halaman admin
     */
    public function index()
    {
        // Admin melihat SEMUA varian,
        // baik yang aktif maupun nonaktif,
        // dan baik stoknya ada maupun habis.
        $variants = ProductVariant::with('product')
            ->latest()
            ->get();

        return view('admin.product_variant.index', compact('variants'));
    }

    /**
     * Menampilkan form tambah varian
     */
    public function create()
    {
        $products = Product::where('status', true)->get();

        return view('admin.product_variant.create', compact('products'));
    }

    /**
     * Menyimpan varian produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size'       => 'required|string|max:50',
            'price'      => 'required|numeric|min:0',
            'stock'      => 'required|integer|min:0',
        ]);

        ProductVariant::create([
            'product_id'      => $request->product_id,
            'size'            => $request->size,
            'price'           => $request->price,
            'stock'           => $request->stock,
            'point'           => 0,
            'is_point_active' => false,
            'is_active'       => true,
        ]);

        return redirect()
            ->route('admin.product-variants.index')
            ->with('success', 'Varian produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit varian
     */
    public function edit(ProductVariant $productVariant)
    {
        $products = Product::where('status', true)->get();

        return view(
            'admin.product_variant.edit',
            compact('productVariant', 'products')
        );
    }

    /**
     * Memperbarui data varian
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size'       => 'required|string|max:50',
            'price'      => 'required|numeric|min:0',
            'stock'      => 'required|integer|min:0',
        ]);

        $productVariant->update([
            'product_id' => $request->product_id,
            'size'       => $request->size,
            'price'      => $request->price,
            'stock'      => $request->stock,
        ]);

        return redirect()
            ->route('admin.product-variants.index')
            ->with('success', 'Varian produk berhasil diperbarui.');
    }

    /**
     * Mengaktifkan / menonaktifkan varian
     */
    public function toggleStatus(ProductVariant $productVariant)
    {
        $productVariant->update([
            'is_active' => !$productVariant->is_active,
        ]);

        if ($productVariant->is_active) {
            $message = 'Varian produk berhasil diaktifkan.';
        } else {
            $message = 'Varian produk berhasil dinonaktifkan.';
        }

        return redirect()
            ->route('admin.product-variants.index')
            ->with('success', $message);
    }

    /**
     * Tidak menghapus varian.
     *
     * Gunakan Aktif/Nonaktif agar riwayat pesanan tetap aman.
     */
    public function destroy(ProductVariant $productVariant)
    {
        return redirect()
            ->route('admin.product-variants.index')
            ->with(
                'error',
                'Varian tidak dapat dihapus. Gunakan tombol Aktif/Nonaktif.'
            );
    }
}