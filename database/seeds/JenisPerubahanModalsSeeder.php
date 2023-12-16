<?php

use Illuminate\Database\Seeder;

class JenisPerubahanModalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_jenis_perubahan_modals')->insert([
            [
                'name' => 'Aset',
                'description' => 'Aset adalah segala sesuatu yang dimiliki oleh suatu entitas bisnis yang memiliki nilai ekonomi dan dapat memberikan manfaat ekonomi di masa depan. Aset dapat berupa properti, peralatan, uang tunai, piutang, investasi, dan aset lainnya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kewajiban',
                'description' => 'Kewajiban adalah kewajiban finansial atau tanggung jawab suatu entitas bisnis terhadap pihak ketiga, seperti kreditur atau pemasok, yang timbul dari transaksi atau peristiwa masa lalu. Kewajiban mencakup utang, piutang, dan kewajiban lainnya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ekuitas',
                'description' => 'Ekuitas, atau juga disebut modal sendiri, adalah bagian residual dari aset setelah dikurangkan oleh kewajiban. Dalam istilah sederhana, ekuitas dapat dianggap sebagai klaim pemilik terhadap aset perusahaan setelah memenuhi semua kewajiban.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
