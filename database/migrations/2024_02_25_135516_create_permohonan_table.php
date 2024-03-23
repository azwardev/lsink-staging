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
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->string('tajuk');
            $table->integer('status'); // cth : 1 - Pending
            $table->integer('jenis_permohonan'); // cth : 1 - Permohonan baru
            $table->integer('nama_permohonan'); // cth : 1 - Pengabstrakan air
            $table->integer('akaun'); //Individu atau bisnus
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('borang_id');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->string('bill_id')->nullable();
            $table->string('invoice')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('borang_id')->references('id')->on('borang')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payment')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan');
    }
};
