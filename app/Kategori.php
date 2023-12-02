<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'tbl_kategori';

    protected $fillable = [
        'jenis_id',
        'name',
        'description',
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
}
