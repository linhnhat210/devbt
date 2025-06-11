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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // tên đại lý
            $table->string('address'); // địa chỉ
            $table->string('tax_code'); // mã số thuế
            $table->string('phone'); // số điện thoại
            $table->string('email'); // email
            $table->string('contact_person')->nullable(); // người liên hệ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
