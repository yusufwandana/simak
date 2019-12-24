<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
 
class CreateExportNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW export_nilai AS 
        SELECT mahasiswas.nim, mahasiswas.nama, matkuls.id as matkul_id, matkuls.matakuliah, semesters.id as semester_id ,semesters.semester, nilais.jenis_nilai, nilais.nilai 
        FROM nilais, mahasiswas, matkuls, semesters
        WHERE nilais.mahasiswa_id = mahasiswas.id
        AND nilais.matkul_id = matkuls.id
        AND matkuls.semester_id = semesters.id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW export_nilai');
    }
}
