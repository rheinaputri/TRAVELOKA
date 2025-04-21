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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id('id_pemesanan'); // PRIMARY KEY + AUTO_INCREMENT

            $table->unsignedBigInteger('id_wisatawan');
            $table->unsignedBigInteger('id_kota');
            $table->unsignedBigInteger('id_paket');

            $table->integer('jumlah_orang');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');

            $table->timestamps(); // created_at dan updated_at

            // Foreign key constraints
            $table->foreign('id_wisatawan')->references('id_wisatawan')->on('wisatawan')->onDelete('cascade');
            $table->foreign('id_kota')->references('id_kota')->on('kota')->onDelete('cascade');
            $table->foreign('id_paket')->references('id_paket')->on('paket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
