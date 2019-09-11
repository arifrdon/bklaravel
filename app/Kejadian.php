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
    public function newPivot(Model $parent, array $attributes, $table, $exists, $using = null)
    {
        if ($parent instanceof Siswa) {
            return KejadianSiswaPivot::fromRawAttributes($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
    }
    // protected static function boot() {
    //     parent::boot();

    //     static::deleted(function ($kejadian) {
    //         $kejadian->kejadian_siswa()->delete();
    //     });
    // }
    protected static function boot() 
    {
      parent::boot();
      static::deleting(function($kejadian) {
         foreach ($kejadian->kejadian_siswa()->get() as $kejadian_siswa) {
            $kejadian_siswa->delete();
         }
      });
    }
}
