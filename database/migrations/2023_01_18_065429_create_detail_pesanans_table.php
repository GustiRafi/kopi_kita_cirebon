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
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pesanan')->references('id')->on('pesanans')->onDelete('cascade');
            $table->foreignId('id_menu')->references('id')->on('menus')->onDelete('cascade');
            $table->integer('qty');
            $table->bigInteger('sub_total');
            $table->text('keterangan_pesanan');
            $table->enum('status',['dimasak','sudah_siap']);
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
        Schema::dropIfExists('detail_pesanans');
    }
};
