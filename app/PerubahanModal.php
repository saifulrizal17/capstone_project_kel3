<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getTanggalPerubahanAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_perubahan'])->isoFormat('D MMMM Y');
    }

    public function getTanggalPerubahanFormattedForInput()
    {
        return Carbon::parse($this->attributes['tanggal_perubahan'])->format('Y-m-d');
    }
}
