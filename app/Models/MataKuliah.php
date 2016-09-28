<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MataKuliah extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tbl_mk';
    protected $dates = ['deleted_at'];
    protected $fillable = ['kd_mk','nama_mk','sks','semester','prasyarat_mk','jurusan'];


    public function jadwal(){
    	return $this->hasMany('App\Models\Jadwal','mk_id','id');
    }

    public function dosen()
    {
        return $this->hasManyThrough('App\Models\Dosen', 'App\Models\Jadwal','mk_id', 'id', 'mk_id');
    }

    public function scopeSelectBox($query)
    {
    	$return = array();
        $data = $query->orderBy('kd_mk')->get()->toArray();
        foreach ($data as $key => $value) {
        	$return[$value['id']] = $value['kd_mk'].' - '.$value['nama_mk'];
        }
        return $return;
    }

}
