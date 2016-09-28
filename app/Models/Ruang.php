<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruang extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tbl_ruang';
    protected $dates = ['deleted_at'];
    protected $fillable = ['nama_ruang'];
}
