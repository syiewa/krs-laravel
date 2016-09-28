<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'role' => 'string',
    ];

    public function mahasiswa(){
        return $this->belongsTo('App\Models\Mahasiswa','id','user_id');
    }

    public function dosen(){
        return $this->belongsTo('App\Models\Dosen','id','user_id');
    }
}
