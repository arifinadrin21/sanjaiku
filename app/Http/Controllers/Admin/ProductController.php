<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->get();

        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:100',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
        ]);

        // Slug unik
        $slug = Str::slug($request->name);

        $count = Product::where('slug', 'LIKE', "{$slug}%")->count();

        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        // Upload gambar
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = $this->saveOptimizedImage(
                $request->file('image'),
                $request->name
            );
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('status', true)->get();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:100',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
        ]);

        // Slug unik
        $slug = Str::slug($request->name);

        $count = Product::where('slug', 'LIKE', "{$slug}%")
            ->where('id', '!=', $product->id)
            ->count();

        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $imageName = $product->image;

        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if (
                $product->image &&
                Storage::disk('public')->exists('products/' . $product->image)
            ) {
                Storage::disk('public')->delete(
                    'products/' . $product->image
                );
            }

            // Simpan gambar baru dalam format WebP
            $imageName = $this->saveOptimizedImage(
                $request->file('image'),
                $request->name
            );
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if (
            $product->image &&
            Storage::disk('public')->exists('products/' . $product->image)
        ) {
            Storage::disk('public')->delete(
                'products/' . $product->image
            );
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Simpan gambar produk yang sudah dioptimalkan.
     *
     * - Maksimal 600x600 px
     * - Format WebP
     * - Kualitas 80
     */
    private function saveOptimizedImage($file, string $productName): string
    {
        $source = imagecreatefromstring(
            file_get_contents($file->getRealPath())
        );

        if (!$source) {
            throw new \Exception('Gambar tidak dapat diproses.');
        }

        $originalWidth = imagesx($source);
        $originalHeight = imagesy($source);

        // Ukuran maksimal
        $maxWidth = 600;
        $maxHeight = 600;

        // Pertahankan rasio gambar
        $ratio = min(
            $maxWidth / $originalWidth,
            $maxHeight / $originalHeight,
            1
        );

        $newWidth = (int) round($originalWidth * $ratio);
        $newHeight = (int) round($originalHeight * $ratio);

        // Buat canvas baru
        $optimized = imagecreatetruecolor(
            $newWidth,
            $newHeight
        );

        // Background putih untuk gambar produk
        $white = imagecolorallocate(
            $optimized,
            255,
            255,
            255
        );

        imagefill(
            $optimized,
            0,
            0,
            $white
        );

        // Resize
        imagecopyresampled(
            $optimized,
            $source,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $originalWidth,
            $originalHeight
        );

        // Nama file WebP
        $fileName = time() . '_' .
            Str::slug($productName) .
            '.webp';

        $path = Storage::disk('public')->path(
            'products/' . $fileName
        );

        // Simpan WebP kualitas 80
        imagewebp(
            $optimized,
            $path,
            80
        );

        // Bersihkan memory
        imagedestroy($source);
        imagedestroy($optimized);

        return $fileName;
    }
}