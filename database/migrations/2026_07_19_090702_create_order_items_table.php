<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('product_variant_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Nama produk disimpan agar riwayat tidak berubah
            $table->string('product_name');

            // Ukuran produk
            $table->string('size');

            // Harga saat transaksi
            $table->decimal('price',12,2);

            // Jumlah beli
            $table->integer('quantity');

            // Poin dari produk ini
            $table->integer('point')->default(0);

            // Total harga item
            $table->decimal('subtotal',12,2);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};