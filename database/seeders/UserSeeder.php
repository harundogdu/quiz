<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Harun Doğdu',
            'email' => 'harundogdu06@gmail.com',
            'email_verified_at' => now(),
            'type' => 'admin',
            'password' => bcrypt(12345678), // 12345678
            'remember_token' => Str::random(10),
        ]);
        /* \App\Models\User::factory(10)->create(); */
    }
}
