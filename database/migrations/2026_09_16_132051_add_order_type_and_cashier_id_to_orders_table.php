<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->enum('order_type', ['online', 'kasir'])
                ->default('online')
                ->after('id');

            $table->foreignId('cashier_id')
                ->nullable()
                ->after('order_type')
                ->constrained('users')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropForeign(['cashier_id']);
            $table->dropColumn([
                'order_type',
                'cashier_id'
            ]);

        });
    }
};