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
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id('id_destinasi'); // Primary key + AUTO_INCREMENT
            $table->string('nama_destinasi', 250);
            $table->unsignedBigInteger('id_kota'); // foreign key ke tabel kota
            $table->unsignedBigInteger('id_paket'); // foreign key ke tabel paket
            $table->timestamps();

            // Foreign Key Constraints (kalau tabel relasinya sudah ada)
            $table->foreign('id_kota')->references('id_kota')->on('kota')->onDelete('cascade');
            $table->foreign('id_paket')->references('id_paket')->on('paket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi');
    }
};
