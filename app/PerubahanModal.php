<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PerubahanModal extends Model
{
    protected $table = 'tbl_perubahan_modals';

    protected $fillable = [
        'id_user',
        'id_jenis',
        'tanggal_perubahan',
        'keterangan',
        'jumlah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisPerubahanModal::class, 'id_jenis');
    }

    public function getTanggalPerubahanAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_perubahan'])->isoFormat('D MMMM Y');
    }

    public function getTanggalPerubahanFormattedForInput()
    {
        return Carbon::parse($this->attributes['tanggal_perubahan'])->format('Y-m-d');
    }
}
