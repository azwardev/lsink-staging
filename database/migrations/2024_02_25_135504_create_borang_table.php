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
        Schema::create('borang', function (Blueprint $table) {
            $table->id();
            $table->json('borang_a')->nullable();
            $table->json('borang_b')->nullable();
            $table->json('borang_c')->nullable();
            $table->json('borang_d')->nullable();
            $table->json('borang_e')->nullable();
            $table->json('borang_r')->nullable();
            $table->json('borang_g')->nullable();
            $table->json('borang_h')->nullable();
            $table->json('borang_i')->nullable();
            $table->json('file_upload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borang');
    }
};
