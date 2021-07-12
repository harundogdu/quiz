<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $quizzes = Quiz::where('status','published')->withCount('questions')->orderBy('updated_at','DESC')->paginate(5);
        return view('dashboard',compact('quizzes'));
    }
    public function quizDetails($slug){
        $quiz = Quiz::whereSlug($slug)->withCount('questions')->first() ?? abort(404, 'Böyle Bir Quiz Bulunamadı!');
        return view('quiz-details', compact('quiz'));
    }
}
