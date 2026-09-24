<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voucher_redemptions', function (Blueprint $table) {

            $table->id();

            // Pemilik voucher
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Voucher
            $table->foreignId('voucher_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Order yang menggunakan voucher (boleh kosong)
            $table->foreignId('order_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Status voucher
            $table->enum('status',[
                'belum_digunakan',
                'digunakan',
                'kedaluwarsa'
            ])->default('belum_digunakan');

            // Waktu digunakan
            $table->timestamp('used_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_redemptions');
    }
};