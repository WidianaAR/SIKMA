<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressKPTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_kp', function (Blueprint $table) {
            $table->increments('no_progress');
            $table->integer('no_kp');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->text('komentar')->nullable();
            $table->smallInteger('nilai')->nullable();
            $table->string('file', 255)->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress_k_p');
    }
}
