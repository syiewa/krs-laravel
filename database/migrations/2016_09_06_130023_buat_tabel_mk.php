<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelMk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kd_mk');
            $table->string('nama_mk');
            $table->integer('sks');
            $table->integer('semester');
            $table->string('prasyarat_mk')->nullable();
            $table->string('jurusan');
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
        Schema::dropIfExists('tbl_mk');
    }
}
