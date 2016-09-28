<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelThnajaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_thnajaran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kd_tahun');
            $table->text('keterangan');
            $table->date('tgl_kuliah');
            $table->date('tgl_awal_perwalian');
            $table->date('tgl_akhir_perwalian');
            $table->integer('status');
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
        Schema::dropIfExists('tbl_thnajaran');
    }
}
