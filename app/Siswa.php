<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = "siswa";

    protected $fillable = ['nisn','id_ortu','id_kelas','nama_siswa','tempat_lahir','tanggal_lahir','jenis_kelamin'];

    public function kelassw()
    {
        return $this->belongsTo('App\Kelassw','id_kelas');
    }

    public function user()
    {
        return $this->belongsTo('App\User','id_ortu');
    }
    public function kejadian_siswa()
    {
        return $this->hasMany('App\Kejadian_siswa', 'id_siswa');
    }
    public function kejadian()
    {
            return $this->belongsToMany('App\Kejadian', 'kejadian_siswa', 'id_siswa', 'id_kejadian')->withPivot('tanggaljam_kejadian', 'status_terkirim','deleted_at')->withTimeStamps()->wherePivot('deleted_at',null);
    }
    
}