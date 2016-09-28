<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Krs extends Model
{
    //
    protected $table = 'tbl_krs';
    protected $dates = ['deleted_at'];
    protected $fillable = ['mahasiswa_id','tgl_krs','tgl_persetujuan','status','semester','thnajaran_id'];
    protected $appends = ['statuta'];

    public function krsdetil(){
    	return $this->hasMany('App\Models\KrsDetil','krs_id','id');
    }

    public function mahasiswa(){
    	return $this->belongsTo('App\Models\Mahasiswa','mahasiswa_id','id');
    }

    public function getStatutaAttribute(){
        $status  = $this->attributes['status'];
        switch ($status) {
            case 0:
                # code...
                return 'Belum Disetujui';
                break;
            case 1:
                # code...
                return 'Sudah Disetujui';
                break;
            case 2:
                return 'Sudah Dinilai';
                break;
            default:
                # code...
                break;
        }
    }
}
