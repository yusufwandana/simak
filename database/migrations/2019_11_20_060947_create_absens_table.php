<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absens', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->integer('dosen_id')->unsigned();
            $table->integer('mahasiswa_id')->unsigned();
            $table->integer('matkul_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->integer('keterangan');
            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('cascade');
            $table->foreign('matkul_id')->references('id')->on('matkuls')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
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
        Schema::dropIfExists('absens');
    }
}
