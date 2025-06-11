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
        Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Tên thiết bị, vật tư
        $table->string('code'); // Mã chủng loại
        $table->decimal('internal_price', 15, 2); // Giá nội bộ
        $table->integer('warranty_period'); // Thời gian bảo hành (đơn vị tháng)
        $table->text('description')->nullable(); // Thông tin
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
