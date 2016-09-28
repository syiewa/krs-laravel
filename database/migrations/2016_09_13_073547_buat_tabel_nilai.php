<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelNilai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_nilai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('krsdetil_id');
            $table->integer('mahasiswa_id');
            $table->integer('bobot_id');
            $table->integer('thnajaran_id');
            $table->integer('semester_ditempuh');
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
        Schema::dropIfExists('tbl_nilai');
    }
}
