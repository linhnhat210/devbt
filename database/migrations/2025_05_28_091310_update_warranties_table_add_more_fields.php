<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('warranties', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('expired_at');
            $table->unsignedBigInteger('device_id')->nullable()->after('imei');
            $table->string('type')->nullable()->after('device_id');
            $table->unsignedBigInteger('created_by')->nullable()->after('warranty_user_id');
            $table->text('note')->nullable()->after('error_description');
            $table->string('attachment')->nullable()->after('note');

            $table->foreign('device_id')->references('id')->on('devices')->nullOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('warranties', function (Blueprint $table) {
            $table->dropColumn([
                'start_date', 'device_id', 'type',
                'created_by', 'note', 'attachment'
            ]);
        });
    }
};
