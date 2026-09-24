<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->enum('payment_method', [
                'cod',
                'qris'
            ])->after('address');

            $table->enum('payment_status', [
                'belum_bayar',
                'menunggu_verifikasi',
                'lunas'
            ])->default('belum_bayar')->after('payment_method');

            $table->string('payment_proof')
                ->nullable()
                ->after('payment_status');

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'payment_method',
                'payment_status',
                'payment_proof'
            ]);

        });
    }
};