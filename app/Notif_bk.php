<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notif_bk extends Model
{
    protected $table = "notif_bk";

    protected $fillable = [
        'id_forum',
        'sudah_baca',
    ];

    public function forum_kejadian()
    {
        return $this->belongsTo('App\Forum_kejadian','id_forum');
    }
}
