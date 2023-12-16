<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriCatatanKeuangan extends Model
{
    protected $table = 'tbl_kategori_catatan_keuangans';

    protected $fillable = [
        'id_jenis',
        'name',
        'description',
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }
}
