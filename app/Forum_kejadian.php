<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum_kejadian extends Model
{
    use SoftDeletes;

    protected $table = "forum_kejadian";

    protected $fillable = [
        'id_kejadian_siswa',
        'id_user',
        'nama_siswa',
    ];

    public function kejadian_siswa()
    {
        return $this->belongsTo('App\Kejadian_siswa','id_kejadian_siswa');
    }
    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }
    public function notif_bk()
    {
        return $this->hasMany('App\Notif_bk','id_forum');
    }
}
