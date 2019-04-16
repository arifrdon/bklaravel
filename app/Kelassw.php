<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelassw extends Model
{
    protected $table = "kelassw";
    protected $fillable = [
        'nama_kelas','id_wali_kelas'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','id_wali_kelas');
    }

    public function siswa()
    {
        return $this->hasMany('App\Siswa', 'id_kelas');
    }
}
