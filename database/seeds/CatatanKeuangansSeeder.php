<?php

use Illuminate\Database\Seeder;

class CatatanKeuangansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_catatan_keuangans')->insert([
            [
                'id_user' => 2,
                'id_jenis' => 1,
                'id_kategori' => 1,
                'tanggal_transaksi' => now(),
                'jumlah' => 5000000.00,
                'keterangan' => 'Gaji Bulanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'id_jenis' => 2,
                'id_kategori' => 2,
                'tanggal_transaksi' => now(),
                'jumlah' => 1500000.00,
                'keterangan' => 'Membeli Kebutuhan Pokok',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
