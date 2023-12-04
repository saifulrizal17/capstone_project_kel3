<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Neraca extends Model
{
    protected $table = 'tbl_neraca';

    protected $fillable = [
        'id_user',
        'aset',
        'kewajiban',
        'ekuitas',
        'bulan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getBulanAttribute()
    {
        return Carbon::parse($this->attributes['bulan'])->isoFormat('MMMM');
    }
}
