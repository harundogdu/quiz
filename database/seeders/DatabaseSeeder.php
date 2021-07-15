<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            UserSeeder::class,
            QuizSeeder::class,
            QuestionSeeder::class
            /* AnswerSeeder::class */
            /* ResultSeeder::class */
       ]);
    }
}
