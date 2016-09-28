<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelMhs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nim');
            $table->string('nama_mahasiswa');
            $table->string('angkatan');
            $table->string('jurusan');
            $table->string('kelas_program');
            $table->integer('dosen_id');
            $table->integer('user_id');
            $table->softDeletes();
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
        Schema::dropIfExists('tbl_mahasiswa');
    }
}
