<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nama_mahasiswa', 50)->primary();
            $table->string('email', 30)->unique();
            $table->bigInteger('NIM')->unique();
            $table->string('prodi', 30);
            $table->string('jurusan', 50);
            $table->smallInteger('angkatan');
            $table->bigInteger('telp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
