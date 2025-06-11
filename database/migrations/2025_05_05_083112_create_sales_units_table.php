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
        Schema::create('sales_units', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên đơn vị bán hàng (ví dụ: kg, cái, hộp, v.v.)
            $table->string('description')->nullable(); // Mô tả đơn vị bán hàng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_units');
    }
};
