<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $quiz = Quiz::whereId($id)->with('questions')->first() ?? abort(404, 'Quiz Bulunamadı!');
        return view('admin.question.list', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quiz_id)
    {
        $quiz = Quiz::find($quiz_id) ?? abort(404, "Böyle Bir Quiz Bulunamadı!");
        return view('admin.question.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request, $quiz_id)
    {

        if ($request->hasFile('image')) {
            $fileName = Str::slug($request->question) . "." . $request->image->extension();
            $fileNameWithUpload = 'uploads/' . $fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload
            ]);
        }

        Quiz::find($quiz_id)->questions()->create($request->post()) ?? abort(404, 'Böyle Bir Quiz Bulunamadı!');

        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru Başarıyla Oluşturuldu!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id, $question_id)
    {
       /*  $quiz = Quiz::find($quiz_id) ?? abort(404, 'Böyle Bir Quiz Bulunamadı!');
        $question = Question::find($question_id) ?? abort(404, 'Böyle Bir Soru Bulunamadı!'); */
        $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404, 'Böyle Bir Sayfa Bulunamadı!');
        return view('admin.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $quiz_id, $question_id)
    {
        /*
            1.Yol
        Quiz::find($quiz_id) ?? abort(404,'Böyle Bir Quiz Bulunamadı!');
        $question = Question::find($question_id) ?? abort(404,'Böyle Bir Question Bulunamadı!'); */
        //  2.Yol
        $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404, 'Böyle Bir Sau Bulunamadı!');

        $question->question = $request->question;
        $question->answer1 = $request->answer1;
        $question->answer2 = $request->answer2;
        $question->answer3 = $request->answer3;
        $question->answer4 = $request->answer4;
        $question->correct_answer = $request->correct_answer;

        if ($request->hasFile('image')) {
            $fileName = Str::slug($request->question) . "." . $request->image->extension();
            $fileNameWithUpload = 'uploads/' . $fileName;
            if (File::exists(public_path($question->image))) {
                File::delete(public_path($question->image));
            }
            $request->image->move(public_path('uploads'), $fileName);
            $question->image = $fileNameWithUpload;
        }

        $question->update();

        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru Başarıyla Güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id , $question_id)
    {
        Quiz::find($quiz_id)->questions()->whereId($question_id)->delete();
        return redirect()->route('questions.index',$quiz_id)->withSuccess('Soru Başarıyla Silindi!');
    }
}
