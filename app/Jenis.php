<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'tbl_jenis';

    protected $fillable = [
        'jenis',
    ];

    public function kategoris()
    {
        return $this->hasMany(Kategori::class, 'jenis_id');
    }
}