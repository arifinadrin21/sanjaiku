<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {

            $table->id();

            // Kode Voucher
            $table->string('code')->unique();

            // Nama Voucher
            $table->string('name');

            // Jenis voucher
            $table->enum('type', [
                'nominal',
                'percent'
            ])->default('nominal');

            // Nilai voucher
            $table->decimal('discount_amount',12,2);

            // Minimal belanja
            $table->decimal('minimum_purchase',12,2)->default(0);

            // Kuota
            $table->integer('quota')->default(100);

            // Sudah digunakan
            $table->integer('used')->default(0);

            // Berlaku mulai
            $table->date('start_date');

            // Berakhir
            $table->date('expired_date');

            // Aktif
            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};