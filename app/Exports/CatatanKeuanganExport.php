<?php

namespace App\Exports;

use App\CatatanKeuangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CatatanKeuanganExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $data;
    protected $serialNumber = 0;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return new Collection($this->data);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pengguna',
            'Jenis',
            'Kategori',
            'Tanggal Transaksi',
            'Jumlah',
            'Keterangan',
        ];
    }

    public function map($row): array
    {
        return [
            ++$this->serialNumber,
            $row['user']['name'],
            $row['jenis']['name'],
            $row['kategori']['name'],
            $row['tanggal_transaksi'],
            $row['jumlah'],
            $row['keterangan'],
        ];
    }
}
