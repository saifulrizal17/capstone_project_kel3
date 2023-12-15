<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class ManajemenUsersImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $rows->shift();

        foreach ($rows as $row) {
            $user = new User([
                'name' => $row[0],
                'email' => $row[1],
                'phone_number' => $row[2],
                'job_title' => $row[3],
                'address' => $row[4],
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role_id' => 2,
                'is_active' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user->save();
        }
    }
}
