<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            // Relasi ke kategori
            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            // Nama produk
            $table->string('name',150);

            // Slug untuk URL
            $table->string('slug')->unique();

            // Deskripsi singkat
            $table->text('description')->nullable();

            // Gambar utama
            $table->string('image')->nullable();

            // Status produk
            $table->enum('status',['aktif','nonaktif'])
                  ->default('aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};