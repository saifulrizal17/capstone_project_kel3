<?php

use Illuminate\Database\Seeder;

class CatatanKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_catatan_keuangan')->insert([
            [
                'id_user' => 1,
                'id_jenis' => 1,
                'id_kategori' => 3,
                'tanggal_transaksi' => '2023-01-01',
                'jumlah' => 1000.00,
                'keterangan' => 'Pengeluaran untuk keperluan A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'id_jenis' => 1,
                'id_kategori' => 1,
                'tanggal_transaksi' => '2023-01-02',
                'jumlah' => 1500.50,
                'keterangan' => 'Pendapatan dari pekerjaan B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
