<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatatanKeuangan extends Model
{
    protected $table = 'tbl_catatan_keuangan';
    
    protected $fillable = [
        'id_user',
        'tanggal_transaksi',
        'jumlah',
        'keterangan',
        'jenis',
        'kategori',
    ];
}