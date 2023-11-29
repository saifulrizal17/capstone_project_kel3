<?php

// app/TblPerubahanModal.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblPerubahanModal extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $table = 'tbl_perubahan_modal';
    protected $fillable = [
        'id',
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

