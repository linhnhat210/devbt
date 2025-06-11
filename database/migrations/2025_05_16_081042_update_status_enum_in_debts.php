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
        Schema::table('debts', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('debts', function (Blueprint $table) {
            $table->enum('status', ['Chờ thanh toán', 'Hoàn thành', 'Hủy'])->default('Chờ thanh toán');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('debts', function (Blueprint $table) {
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
        });
    }
};
