<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tbl_jadwal';
    protected $dates = ['deleted_at'];
    protected $fillable = ['mk_id','dosen_id','thnajaran_id','hari','waktu_mulai','waktu_selesai','program','kelas','ruang_id','kapasitas'];
    protected $appends = ['jadwal'];

    public function dosen(){
    	return $this->belongsTo(
            'App\Models\Dosen','dosen_id','id'
        );
    }

    public function krsdetil(){
        return $this->hasMany('App\Models\KrsDetil','jadwal_id','id');
    }

    public function scopePeserta($q){
        $peserta = $q->withCount(['krsdetil' => function ($k) {
            $k->whereHas('krs',function($krs){
                $krs->where('status',1);
            });
        }]);
        return $peserta->pluck('krsdetil_count','id')->toArray();
    }

    public function scopeCalonPeserta($q){
        $peserta = $q->withCount(['krsdetil' => function ($k) {
            $k->whereHas('krs',function($krs){
                $krs->where('status',0);
            });
        }]);
        return $peserta->pluck('krsdetil_count','id')->toArray();
    }

    public function matakuliah(){
        return $this->belongsTo('App\Models\Matakuliah','mk_id','id');
    }

    public function ruang(){
        return $this->hasOne('App\Models\Ruang','id','ruang_id');
    }

    public function thnajaran(){
        return $this->hasOne('App\Models\ThnAjaran','id','thnajaran_id');
    }

    public function getWaktuMulaiAttribute($value)
    {
        return date('H:i',strtotime($value));
    }

    public function getWaktuSelesaiAttribute($value)
    {
        return date('H:i',strtotime($value));
    }

    public function getJadwalAttribute(){
        $hari = $this->attributes['hari'];
        $jam = date('H:i',strtotime($this->attributes['waktu_mulai'])).'-'.date('H:i',strtotime($this->attributes['waktu_selesai']));
        switch ($hari) {
            case 'Mon':
                $data = 'Senin';
                break;
            case 'Tue':
                $data = 'Selasa';
                break;
            case 'Wed':
                $data = 'Rabu';
                break;
            case 'Thu':
                $data = 'Kamis';
                break;
            case 'Fri':
                $data = 'Jumat';
                break;
            case 'Sat':
                $data = 'Sabtu';
                break;
            default:
                # code...
                break;
        }
        return $data.' / '.$jam;
    }
}
