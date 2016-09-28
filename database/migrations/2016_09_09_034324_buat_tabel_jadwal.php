<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mk_id');
            $table->integer('dosen_id');
            $table->string('thnajaran_id');
            $table->enum('hari', ['Mon', 'Tue','Wed','Thu','Fri','Sat']);
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->enum('program',['Sore','Pagi']);
            $table->string('kelas');
            $table->integer('kapasitas');
            $table->integer('ruang_id');
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
        Schema::dropIfExists('tbl_jadwal');
    }
}
