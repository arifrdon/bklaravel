<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class KejadianSiswaPivot extends Pivot
{
    protected $dates = ['tanggaljam_kejadian'];
}
