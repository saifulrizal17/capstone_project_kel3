<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerubahanModal extends Model
{
    protected $table = 'tbl_perubahan_modal';

    protected $fillable = [
        'id_user',
        'tanggal_perubahan',
        'keterangan',
        'jumlah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
