<x-app-layout>
    <x-slot name="header">
        <div class="clearfix d-flex justify-content-between">
            <span>Soru Oluştur <i class="text-primary fa fa-plus"></i></span>
            <span class="font-weight-bold text-danger text-right flex-grow-1">{{ $question->question }}</span>
        </div>
    </x-slot>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('questions.update', [$question->quiz_id,$question->id]) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group my-2">
                            <label for="question">Soru Başlığı <span class="text-danger">*</span></label>
                            <textarea name="question" id="question" cols="30" rows="5"
                                class="form-control appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="enter question" required>{{ $question->question }}</textarea>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="answer1">Cevap 1 <span class="text-danger">*</span></label>
                                <textarea name="answer1" id="answer1" cols="20" rows="3" class="form-control"
                                    placeholder="enter answer 1" required>{{ $question->answer1 }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="answer2">Cevap 2 <span class="text-danger">*</span></label>
                                <textarea name="answer2" id="answer2" cols="20" rows="3" class="form-control"
                                    placeholder="enter answer 2" required>{{ $question->answer2 }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="answer3">Cevap 3 <span class="text-danger">*</span></label>
                                <textarea name="answer3" id="answer3" cols="20" rows="3" class="form-control"
                                    placeholder="enter answer 3" required>{{ $question->answer3 }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="answer4">Cevap 4 <span class="text-danger">*</span></label>
                                <textarea name="answer4" id="answer4" cols="20" rows="3" class="form-control"
                                    placeholder="enter answer 4" required>{{ $question->answer4 }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group my-2">
                                <label for="correct_answer">Doğru Cevap <span class="text-danger">*</span></label>
                                <select name="correct_answer" id="correct_answer" class="form-control" required>
                                    <option @if ($question->correct_answer) === 'answer1') selected @endif value="answer1">
                                        Cevap 1</option>
                                    <option @if ($question->correct_answer) === 'answer2') selected @endif value="answer2">
                                        Cevap 2</option>
                                    <option @if ($question->correct_answer) === 'answer3') selected @endif value="answer3">
                                        Cevap 3</option>
                                    <option @if ($question->correct_answer) === 'answer4') selected @endif value="answer4">
                                        Cevap 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group my-2">
                                <label for="image">Soru Fotoğrafı</label>
                                @if ($question->image)
                                    <img class="img-responsive w-50" src="{{ asset($question->image) }}" alt="">
                                @endif
                                <input type="file" name="image" id="image" class="my-2 form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <b><small id="helpText" class="text-danger">* Zorunlu Alan</small></b>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-2">
                            <button class="btn btn-info w-100 text-white text-bold">Soru Güncelle</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
