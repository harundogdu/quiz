<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:200',
            'description' => 'nullable|min:3|max:1000',
            'finished_at' => 'nullable|after:'.now(),
        ];
    }
    public function attributes(){
        return [
            'title' => 'Quiz Başlığı',
            'description' => 'Quiz Açıklaması',
            'finished_at' => 'Quiz Zamanı'
        ];
    }
}
