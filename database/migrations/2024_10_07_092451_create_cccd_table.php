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
        Schema::create('cccd', function (Blueprint $table) {
            $table->integer('stt_cccd'); // Auto-increment nhưng không phải khóa chính
            $table->string('id_cccd', 12)->primary();
            $table->string('name_cccd', 200);
            $table->date('dob_cccd');
            $table->string('sex_cccd', 5);
            $table->string('nationality_cccd', 100);
            $table->string('home_cccd', 255);
            $table->string('address_cccd', 255);
            $table->string('features_cccd', 255)->nullable(); // "Đặc điểm nhận dạng"
            $table->date('issue_cccd');
            $table->date('doe_cccd');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cccd');
    }
};
