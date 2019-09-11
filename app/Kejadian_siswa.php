<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kejadian_siswa extends Model
{
    use SoftDeletes;
    
    protected $table = "kejadian_siswa";

    protected $fillable = [
        'id_siswa',
        'id_kejadian',
        'tanggaljam_kejadian',
    ];
    protected $dates = [
        'deleted_at','tanggaljam_kejadian'
    ];
    public function siswa()
    {
        return $this->belongsTo('App\Siswa','id_siswa');
    }
    public function kejadian()
    {
        return $this->belongsTo('App\Kejadian','id_kejadian');
    }
    public function forum_kejadian()
    {
        return $this->hasMany('App\Forum_kejadian', 'id_kejadian_siswa');
    }
    // protected static function boot() {
    //     parent::boot();

    //     static::deleted(function ($kejadian_siswa) {
    //         $kejadian_siswa->forum_kejadian()->delete();
    //     });
    // }
    protected static function boot() 
    {
      parent::boot();
      static::deleting(function($kejadian_siswa) {
         foreach ($kejadian_siswa->forum_kejadian()->get() as $forum_kejadian) {
            $forum_kejadian->delete();
         }
      });
    }
}
