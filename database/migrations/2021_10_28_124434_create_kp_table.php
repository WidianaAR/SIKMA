<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKPTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kp', function (Blueprint $table) {
            $table->increments('no_kp');
            $table->string('nama_mahasiswa', 50);
            $table->string('nama_dosen', 50)->nullable();
            $table->string('saran_dospem', 50)->nullable();
            $table->bigInteger('NIM');
            $table->string('judul_kp', 50);
            $table->string('instansi_kp', 30);
            $table->date('semhas')->nullable();
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
        Schema::dropIfExists('_k_p');
    }
}
