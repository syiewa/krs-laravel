<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelKrs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_krs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mahasiswa_id');
            $table->date('tgl_krs');
            $table->date('tgl_persetujuan')->nullable();
            $table->integer('thnajaran_id');
            $table->integer('status')->default(0);
            $table->integer('semester')->default(1);
            $table->softdeletes();
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
        Schema::dropIfExists('tbl_krs');
    }
}
