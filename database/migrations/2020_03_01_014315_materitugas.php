<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Materitugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materitugas', function(Blueprint $table){
            $table->increments('id');
            $table->string('jenis');
            $table->text('deskripsi');
            $table->string('file');
            $table->date('tanggal_tenggat');
            $table->time('waktu_tenggat');
            $table->date('tanggal_post');
            $table->integer('semester_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('matkul_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('matkul_id')->references('id')->on('matkuls')->onDelete('cascade');
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
        Schema::dropIfExists('materitugas');
    }
}
