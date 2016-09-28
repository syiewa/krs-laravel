<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Dosen extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tbl_dosen';
    protected $dates = ['deleted_at'];
    protected $fillable = ['kode_dosen','nidn','nama_dosen','user_id'];

    public function jadwal(){
        return $this->hasMany('App\Models\Jadwal','dosen_id','id');
    }

    public function mahasiswa(){
        return $this->hasMany('App\Models\Mahasiswa','id','dosen_id');
    }
    public function scopeSelectBox($query)
    {
    	$return = array();
        $data = $query->orderBy('kode_dosen')->get()->toArray();
        foreach ($data as $key => $value) {
        	$return[$value['id']] = $value['kode_dosen'].' - '.$value['nama_dosen'];
        }
        return $return;
    }

    public function scopeBimbingan($query,$id){
      return DB::select("SELECT
              `krs`.`id` as krsid, 
              `tbl_mahasiswa`.*,
              COALESCE(SUM(mk.sks), 0) AS j_sks,
              `krs`.`status`
              ,krs.semester
            FROM
              `tbl_mahasiswa` 
              LEFT JOIN `tbl_krs` AS `krs` 
                ON `krs`.`mahasiswa_id` = `tbl_mahasiswa`.`id` 
              LEFT JOIN `tbl_krs_detil` AS `krsd` 
                ON `krsd`.`krs_id` = `krs`.`id` 
              LEFT JOIN `tbl_jadwal` AS `j` 
                ON `j`.`id` = `krsd`.`jadwal_id` 
              LEFT JOIN `tbl_mk` AS `mk` 
                ON `mk`.`id` = `j`.`mk_id` 
            WHERE `tbl_mahasiswa`.`dosen_id` = '$id'
              AND `tbl_mahasiswa`.`deleted_at` IS NULL 
            GROUP BY `tbl_mahasiswa`.`id`,
              `krs`.`id` ");
    }
}
