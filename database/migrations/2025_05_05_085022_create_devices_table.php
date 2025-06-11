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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('imei')->unique();
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // bảng projects
            $table->string('name'); // Tên thiết bị
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // bảng categories
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade'); // bảng warehouses
            $table->foreignId('sales_unit_id')->nullable()->constrained()->onDelete('set null'); // bảng sales_units
            $table->string('serial')->nullable();
            $table->date('manufactured_at')->nullable(); // Ngày sản xuất
            $table->date('expired_at')->nullable(); // Ngày hết hạn
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
