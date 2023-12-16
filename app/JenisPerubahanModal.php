<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPerubahanModal extends Model
{
    protected $table = 'tbl_jenis_perubahan_modals';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function perubahanmodals()
    {
        return $this->hasMany(PerubahanModal::class, 'id_jenis');
    }
}
