<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magang', function (Blueprint $table) {
            $table->increments('no_magang');
            $table->string('nama_mahasiswa', 50)->unique();
            $table->bigInteger('NIM')->unique();
            $table->string('instansi_magang', 30);
            $table->smallInteger('nilai_akhir')->nullable();
            $table->smallInteger('status')->default(0);
            $table->string('keterangan', 50)->default('Data Diproses');
            $table->string('file', 255)->nullable()->unique();
            $table->string('berkas', 255)->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magang');
    }
}
