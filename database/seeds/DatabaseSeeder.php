<?php

use App\CatatanKeuangan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersRoleSeeder::class,
            UsersSeeder::class,
            JenisSeeder::class,
            KategoriSeeder::class,
            CatatanKeuanganSeeder::class,
            PerubahanModalSeeder::class,
            NeracaSeeder::class,
        ]);
    }
}
