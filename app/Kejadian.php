<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Kejadian extends Model
{
    use SoftDeletes;
    
    protected $table = "kejadian";

    protected $fillable = [
        'nama_kejadian',
        'poin_kejadian',
        'tipe_kejadian',
    ];
    protected $dates = [
        'deleted_at',
    ];
    public function kejadian_siswa()
    {
        return $this->hasMany('App\Kejadian_siswa', 'id_kejadian');
    }
    public function siswa()
    {
        return $this->belongsToMany('App\Siswa', 'kejadian_siswa', 'id_kejadian', 'id_siswa')->withPivot('tanggaljam_kejadian', 'status_terkirim','deleted_at')->withTimeStamps();
    }
}
