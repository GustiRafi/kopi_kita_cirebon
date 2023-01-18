<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->date('order_at');
            $table->foreignId('no_meja')->references('no_meja')->on('tables')->onDelete('cascade');
            $table->bigInteger('total_harga');
            $table->bigInteger('bayar')->nullable();
            $table->bigInteger('kembalian')->nullable();
            $table->enum('status_pesanan',['belum_bayar','sudah_bayar']);
            $table->enum('status_makanan_pesanan',['sedang_diproses','siap_antar','telah_tersaji']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
};
