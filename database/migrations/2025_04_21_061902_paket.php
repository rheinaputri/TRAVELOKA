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
        Schema::create('paket_wisata', function (Blueprint $table) {
            $table->id('id_paket'); // PRIMARY KEY + AUTO_INCREMENT
            $table->unsignedBigInteger('id_kota'); // FOREIGN KEY ke tabel kota
            $table->string('nama_paket', 250);
            $table->integer('durasi_hari');
            $table->integer('harga_perorang');
            $table->text('fasilitas');
            $table->timestamps();

            // FOREIGN KEY CONSTRAINT
            $table->foreign('id_kota')->references('id_kota')->on('kota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
