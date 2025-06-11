<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('warranties', function (Blueprint $table) {
            $table->string('status')->default('active'); // Thêm cột trạng thái với giá trị mặc định là 'active'
        });
    }

    public function down()
    {
        Schema::table('warranties', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
