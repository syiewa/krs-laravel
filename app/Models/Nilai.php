<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nilai extends Model
{
    //
    protected $table = 'tbl_nilai';
    protected $fillable = ['krsdetil_id','bobot_id','semester_ditempuh','thnajaran_id','mahasiswa_id'];

    public function bobot(){
    	return $this->hasOne('App\Models\Bobot','id','bobot_id');
    }

    public function matakuliah(){
    	return $this->hasOne('App\Models\MataKuliah','id','matakuliah_id');
    }

    public function krsdetil(){
        return $this->belongsTo('App\Models\KrsDetil','krsdetil_id','id');
    }

    public function scopeIpk($query,$mhs_id,$semester)
    {
        return $query->select( DB::raw('ROUND(
    SUM((tbl_bobot.bobot * tbl_mk.sks)) / SUM(tbl_mk.sks),
    2
  ) AS IPK'))->leftJoin('tbl_bobot', 'tbl_bobot.id', '=', 'tbl_nilai.bobot_id')
        			 ->leftJoin('tbl_krs_detil','tbl_krs_detil.id','tbl_nilai.krsdetil_id')
                     ->leftJoin('tbl_jadwal','tbl_jadwal.id','tbl_krs_detil.jadwal_id')
                     ->leftJoin('tbl_krs','tbl_krs_detil.krs_id','tbl_krs.id')
                     ->leftJoin('tbl_mahasiswa','tbl_mahasiswa.id','tbl_krs.mahasiswa_id')
                     ->leftJoin('tbl_mk','tbl_mk.id','tbl_jadwal.mk_id')
        			 ->where([['tbl_mahasiswa.id',$mhs_id],['semester_ditempuh',$semester-1]])->first();
    }

    public function scopeMaxSks($query,$ipk){
    	$ipk = $ipk->IPK;
    	if($ipk < 2){
			return 15;
			}
		else if(($ipk >= 2) && ($ipk <= 2.50)){
			return 18;
			}
		else if(($ipk >= 2.51) && ($ipk <= 2.74)){
			return 20;
			}
		else if(($ipk >= 2.75) && ($ipk <= 2.99)){
			return 22;
			}
		else if($ipk >= 3) {
			return 24;
		}
    }
}
