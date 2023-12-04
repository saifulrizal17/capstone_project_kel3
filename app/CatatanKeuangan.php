<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CatatanKeuangan extends Model
{
    protected $table = 'tbl_catatan_keuangan';

    protected $fillable = [
        'id_user',
        'tanggal_transaksi',
        'jumlah',
        'keterangan',
        'id_jenis',
        'id_kategori',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function getTanggalTransaksiAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_transaksi'])->isoFormat('D MMMM Y');
    }
}
