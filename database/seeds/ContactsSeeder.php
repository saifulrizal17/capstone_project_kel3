<?php

use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_contacts')->insert([
            [
                'name' => 'Asikin Cuy',
                'email' => 'random789@gmail.com',
                'subject' => 'Tampilan Landing Page',
                'message' => 'Landing Page Sangat Bagus min',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SiKomentar',
                'email' => 'random123@gmail.com',
                'subject' => 'Tampilan Login',
                'message' => 'Tambahakan Fitur Login Google ya min',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
