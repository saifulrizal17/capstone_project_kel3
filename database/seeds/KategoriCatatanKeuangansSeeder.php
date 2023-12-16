<?php

use Illuminate\Database\Seeder;

class KategoriCatatanKeuangansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_kategori_catatan_keuangans')->insert([
            [
                'id_jenis' => 1,
                'name' => 'Gaji Utama',
                'description' => 'Deskripsi Gaji Utama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenis' => 1,
                'name' => 'Pendapatan Sampingan',
                'description' => 'Deskripsi Pendapatan Sampingan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenis' => 2,
                'name' => 'Biaya Hidup Pokok',
                'description' => 'Deskripsi Biaya Hidup Pokok',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenis' => 2,
                'name' => 'Transportasi',
                'description' => 'Deskripsi Transportasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenis' => 1,
                'name' => 'Investasi',
                'description' => 'Deskripsi Investasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenis' => 1,
                'name' => 'Bonus',
                'description' => 'Deskripsi Bonus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenis' => 2,
                'name' => 'Hiburan',
                'description' => 'Deskripsi Hiburan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenis' => 2,
                'name' => 'Pengeluaran Darurat',
                'description' => 'Deskripsi Pengeluaran Darurat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
