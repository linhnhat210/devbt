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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // tên dự án

            // kinh doanh phụ trách (user_id)
            $table->foreignId('sales_user_id')->constrained('users')->onDelete('cascade');

            // kế toán phụ trách (nullable)
            $table->foreignId('accountant_user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('address')->nullable(); // địa chỉ

            // thời gian bắt đầu bảo hành thiết bị
            $table->date('warranty_start_date')->nullable();

            $table->string('status')->default('Đang xử lý'); // trạng thái

            // đại lý (agent_id)
            $table->foreignId('agent_id')->constrained('agents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
