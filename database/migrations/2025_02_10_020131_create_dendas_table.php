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
        Schema::create('dendas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pengembalian')->unsigned();
            $table->foreign('id_pengembalian')->references('id')->on('pengembalians')->onDelete('cascade');
            $table->string('total_denda');
            $table->date('tanggal_telat');
            $table->enum('status_pembayaran', ['belum_dibayar','lunas']);
            $table->enum('denda', ['telat','rusak','hilang']);
            $table->string('diskon');
            $table->string('harga_setelah_diskon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dendas');
    }
};
