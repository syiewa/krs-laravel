<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Mahasiswa extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tbl_mahasiswa';
    protected $dates = ['deleted_at'];
    protected $fillable = ['nim','nama_mahasiswa','angkatan','jurusan','kelas_program','dosen_id','user_id'];


    public function dosen(){
    	return $this->belongsTo('App\Models\Dosen','dosen_id','id');
    }

    public function krs(){
    	return $this->hasMany('App\Models\Krs','mahasiswa_id','id');
    }

}
