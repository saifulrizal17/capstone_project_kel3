<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labarugi extends Model
{
    protected $table = 'tbl_labarugi';

    protected $fillable = [
        'id_user',
        'pendapatan',
        'pengeluaran',
        'bulan',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
