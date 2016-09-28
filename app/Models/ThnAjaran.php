<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThnAjaran extends Model
{
    //
     use SoftDeletes;
    protected $table= 'tbl_thnajaran';
    protected $fillable = ['kd_tahun','keterangan','tgl_kuliah','tgl_awal_perwalian','tgl_akhir_perwalian','status'];
    protected $appends = ['statuta'];

    public function getStatutaAttribute(){
    	$status = $this->attributes['status'];
    	return $status == 1 ? 'Active' : 'Not-Active';
    }
}
