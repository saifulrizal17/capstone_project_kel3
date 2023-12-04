<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Labarugi extends Model
{
    protected $table = 'tbl_labarugi';

    protected $fillable = [
        'id_user',
        'pendapatan',
        'pengeluaran',
        'bulan',
    ];

    public function getBulanAttribute()
    {
        return Carbon::parse($this->attributes['bulan'])->isoFormat('MMMM');
    }
}
