<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::withCount('questions');

        if (request()->get('status')) {
            $quizzes = $quizzes->where('status', request()->get('status'));
        }
        if (request()->get('title')) {
            $quizzes = $quizzes->where('title', 'LIKE', '%' . request()->get('title') . '%');
        }

        $quizzes = $quizzes->orderBy('updated_at', 'DESC')->paginate(5);
        return view('admin.quiz.list', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateRequest $request)
    {
        
        if ($request->hasFile('image')) {
            $fileName = Str::slug($request->title) . "." . $request->image->extension();
            $fileNameWithUpload = 'uploads/' . $fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload
            ]);
        }        
        Quiz::create($request->post());
        return redirect()->route('quizzes.index')->withSuccess('Quiz Başarıyla Oluşturuldu!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404, 'Böyle Bir Quiz Bulunamadı!');
        return view('admin.quiz.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404, 'Böyle Bir Quiz Bulunamadı!');
        return view('admin.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateRequest $request, $id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Böyle Bir Quiz Bulunamadı!');

        if ($request->isFinished) $quiz->finished_at = $request->finished_at;
        else $quiz->finished_at = null;
        if ($request->description) $quiz->description = $request->description;       

        if ($request->hasFile('image')) {
            $fileName = Str::slug($request->title) . "." . $request->image->extension();
            $fileNameWithUpload = 'uploads/' . $fileName;
            if (File::exists(public_path($quiz->image))) {
                File::delete(public_path($quiz->image));
            }
            $request->image->move(public_path('uploads'), $fileName);
            $quiz->image = $fileNameWithUpload;
        }

        $quiz->status = $request->status;
        $quiz->title = $request->title;
        $quiz->update();

        return redirect()->route('quizzes.index')->withSuccess('Quiz Başarıyla Düzenlendi!');       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Böyle Bir Quiz Bulunamadı!');
        $quiz->delete();
        return redirect()->route('quizzes.index')->withSuccess('Quiz Başarıyla Silindi!');;
    }
}
