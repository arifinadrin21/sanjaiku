<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY payment_method
            ENUM(
                'cod',
                'transfer_bca',
                'transfer_bri',
                'transfer_bni',
                'transfer_mandiri',
                'qris',
                'midtrans'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY payment_method
            ENUM(
                'cod',
                'transfer_bca',
                'transfer_bri',
                'transfer_bni',
                'transfer_mandiri',
                'qris'
            ) NOT NULL
        ");
    }
};