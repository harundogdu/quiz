<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('status', 'published')->withCount('questions')->orderBy('updated_at', 'DESC')->paginate(2);
        $results = count(auth()->user()->results) > 0 ? auth()->user()->results : null;
        return view('dashboard', compact('quizzes', 'results'));
    }
    public function quizDetails($slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('my_results', 'results', 'topTen.user')->withCount('questions')->first() ?? abort(404, 'Böyle Bir Quiz Bulunamadı!');
        return view('quiz-details', compact('quiz'));
    }
    public function quizJoin($slug)
    {
        $quiz = Quiz::with('questions.my_answer', 'results', 'my_results')->whereSlug($slug)->first();

        if ($quiz->my_results) {
            return  view('quiz-result', compact('quiz'));
        }

        return view('quiz', compact('quiz'));
    }
    public function quizResult(Request $request, $slug)
    {
        $quiz = Quiz::with('questions')->whereSlug($slug)->first();
        $correct = 0;

        foreach ($quiz->questions as $question) {
            /*   echo $question->id . " - " . $question->correct_answer . " - " . $request->post($question->id) . "<br>"; */
            if ($request->post($question->id) === $question->correct_answer) {
                $correct++;
            }
            Answer::create([
                'user_id' => auth()->user()->id,
                'question_id' => $question->id,
                'answer' => $request->post($question->id)
            ]);
        }

        $point = round(100 / (count($quiz->questions)) * $correct);
        $wrong = count($quiz->questions) - $correct;

        Result::create([
            'user_id' => auth()->user()->id,
            'quiz_id' => $quiz->id,
            'point' => $point,
            'correct' => $correct,
            'wrong' => $wrong
        ]);

        return redirect()->route('quiz-details', $quiz->slug)->withSuccess("Quiz'i Başarıyla Bitirdiniz. Puanınız : " . $point);
    }
}
