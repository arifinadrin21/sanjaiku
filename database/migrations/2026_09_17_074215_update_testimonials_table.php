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
        Schema::table('testimonials', function (Blueprint $table) {

            // Ubah kolom comment menjadi review
            $table->renameColumn('comment', 'review');

            // Hapus kolom verifikasi lama
            $table->dropColumn('is_approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {

            // Kembalikan review menjadi comment
            $table->renameColumn('review', 'comment');

            // Kembalikan kolom verifikasi
            $table->boolean('is_approved')->default(true);
        });
    }
};