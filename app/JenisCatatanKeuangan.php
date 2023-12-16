<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisCatatanKeuangan extends Model
{
    protected $table = 'tbl_jenis_catatan_keuangans';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function kategoris()
    {
        return $this->hasMany(KategoriCatatanKeuangans::class, 'id_jenis');
    }

    public function catatankeuangans()
    {
        return $this->hasMany(CatatanKeuangan::class, 'id_jenis');
    }
}
