<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Result::factory(1000)->create();
    }
}
