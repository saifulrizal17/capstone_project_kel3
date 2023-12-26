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
            UsersRolesSeeder::class,
            UsersSeeder::class,
            JenisCatatanKeuangansSeeder::class,
            KategoriCatatanKeuangansSeeder::class,
            CatatanKeuangansSeeder::class,
            JenisPerubahanModalsSeeder::class,
            PerubahanModalsSeeder::class,
            ContactsSeeder::class,
        ]);
    }
}
