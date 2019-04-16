<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaturan_bk extends Model
{
    protected $table = "pengaturan_bk";

    protected $fillable = [
        'nama_pengaturan',
        'nilai_pengaturan',
    ];
}
