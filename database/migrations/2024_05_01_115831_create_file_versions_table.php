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
        Schema::create('fileversions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_id');
            $table->float('version');
            $table->float('size');
            $table->string('path');
            $table->timestamps();


            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fileversions');
    }
};
