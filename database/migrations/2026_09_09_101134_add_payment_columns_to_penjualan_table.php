<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            if (!Schema::hasColumn('penjualan', 'metode_pembayaran')) {
                $table->enum('metode_pembayaran', ['cash', 'qris'])->default('cash');
            }
            if (!Schema::hasColumn('penjualan', 'uang_masuk')) {
                $table->decimal('uang_masuk', 12, 2)->nullable();
            }
            if (!Schema::hasColumn('penjualan', 'uang_kembalian')) {
                $table->decimal('uang_kembalian', 12, 2)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            if (Schema::hasColumn('penjualan', 'metode_pembayaran')) {
                $table->dropColumn('metode_pembayaran');
            }
            if (Schema::hasColumn('penjualan', 'uang_masuk')) {
                $table->dropColumn('uang_masuk');
            }
            if (Schema::hasColumn('penjualan', 'uang_kembalian')) {
                $table->dropColumn('uang_kembalian');
            }
        });
    }
};