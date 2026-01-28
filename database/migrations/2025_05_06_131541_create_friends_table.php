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
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_from');
            $table->unsignedBigInteger('request_to');
            $table->string('accept')->default(0);
            $table->string('report_status')->default(0);
            $table->string('block')->default(0);
            $table->string('user_block')->default(0);
            $table->timestamps();

            $table->foreign('request_from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('request_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
