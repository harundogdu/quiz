<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quiz_id' =>rand(1,10),
            'question' => $this->faker->realText(15,2),
            'answer1' => $this->faker->realText(20,2),
            'answer2' => $this->faker->realText(20,2),
            'answer3' => $this->faker->realText(20,2),
            'answer4' => $this->faker->realText(20,2),
            'correct_answer' => 'answer'.rand(1,4)
        ];
    }
}
