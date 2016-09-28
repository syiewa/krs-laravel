<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KrsDetil extends Model
{
    //
    protected $table = 'tbl_krs_detil';
    // protected $dates = ['deleted_at'];
    protected $fillable = ['krs_id','jadwal_id'];

    public function jadwal(){
    	return $this->belongsTo('App\Models\Jadwal','jadwal_id','id');
    }

    public function krs(){
    	return $this->belongsTo('App\Models\Krs','krs_id','id');
    }

    public function nilai(){
        return $this->hasOne('App\Models\Nilai','krsdetil_id','id');
    }

    public function scopeTblNilai($query,$id){
        $data = [];
        $temp = $query->where('krs_id',$id)->has('nilai')->get();
        if($temp){
            foreach ($temp as $key=>$value) {
                $data[$value->krs->semester][$key] = $value;
            }
        }
        return $data;
    }
}
