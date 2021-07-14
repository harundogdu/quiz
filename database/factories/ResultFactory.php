<?php

namespace Database\Factories;

use App\Models\Result;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

class ResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Result::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'user_id'=> rand(1,10),
           'quiz_id'=> rand(1,10),
           'point' => rand(0,100),
           'correct' => rand(0,10),
           'wrong' => rand(0,10)
        ];
    }
}
