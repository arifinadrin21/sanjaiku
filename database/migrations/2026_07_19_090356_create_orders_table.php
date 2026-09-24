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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // Nomor invoice
            $table->string('invoice_number')->unique();

            // Pelanggan
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Alamat pengiriman
            $table->string('recipient_name');
            $table->string('phone',20);
            $table->text('address');

            // Ringkasan pembayaran
            $table->decimal('subtotal',12,2)->default(0);
            $table->decimal('shipping_cost',12,2)->default(0);
            $table->decimal('discount',12,2)->default(0);
            $table->decimal('total',12,2)->default(0);

            // Poin yang diperoleh
            $table->integer('earned_points')->default(0);

            // Poin yang diperoleh
            $table->enum('payment_method', [
                'cod',
                'transfer_bca',
                'transfer_bri',
                'transfer_bni',
                'transfer_mandiri',
                'qris'
            ]);

            $table->enum('payment_status', [
                'belum_bayar',
                'menunggu_verifikasi',
                'lunas'
            ])->default('belum_bayar');

            $table->string('payment_proof')->nullable();

            $table->enum('payment_method', [
                'cod',
                'qris'
            ]);

            $table->enum('payment_status', [
                'belum_bayar',
                'menunggu_verifikasi',
                'lunas'
            ])->default('belum_bayar');

        $table->string('payment_proof')->nullable();
            // Status pesanan
            $table->enum('status',[
                'pending',
                'dikonfirmasi',
                'diproses',
                'dikemas',
                'dikirim',
                'selesai',
                'dibatalkan'
            ])->default('pending');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};