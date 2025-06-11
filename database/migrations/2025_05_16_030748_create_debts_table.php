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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('debt_code');
            $table->decimal('amount', 15, 2);
            $table->tinyInteger('debt_type'); // 1: warranty, 2: device, 3: service

            // Nullable foreign keys
            $table->foreignId('warranty_id')->nullable()->constrained('warranties')->onDelete('set null');
            $table->foreignId('device_payment_id')->nullable()->constrained('device_payments')->onDelete('set null');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');

            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->dropForeign(['warranty_id']);
        });
        Schema::dropIfExists('debts');
    }
};
