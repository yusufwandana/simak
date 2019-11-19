<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dosen_id')->unsigned();
            $table->integer('matkul_id')->unsigned();
            $table->integer('ruangan_id')->unsigned();
            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('CASCADE');
            $table->foreign('matkul_id')->references('id')->on('matkuls')->onDelete('CASCADE');
            $table->foreign('ruangan_id')->references('id')->on('ruangans')->onDelete('CASCADE');
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
        Schema::dropIfExists('jadwals');
    }
}
