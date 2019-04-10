<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daftar_kejadian extends Model
{
    protected $table = "daftar_kejadian";

    protected $fillable = [
        'nama_kejadian',
        'poin_kejadian',
        'tipe_kejadian',
    ];
    protected $dates = [
        'deleted_at',
    ];
}
