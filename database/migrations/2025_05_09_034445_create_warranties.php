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
        Schema::create('warranties', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // mã đơn bảo hành
            $table->string('imei')->unique(); // imei thiết bị bảo hành
            $table->date('expired_at'); // thời hạn bảo hành
            $table->unsignedBigInteger('warranty_user_id'); // người bảo hành
            $table->text('error_description')->nullable(); // mô tả lỗi
            $table->timestamps();

             // Foreign keys
            $table->foreign('imei')->references('imei')->on('devices')->onDelete('cascade');
            $table->foreign('warranty_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranties');
    }
};
