<x-app-layout>
    <x-slot name="header">
        <div class="clearfix">
            <span class="float-start">{{ $quiz->title }}</span>
            <span class="float-end">
                <a href="{{ route('quiz-details', $quiz->slug) }}" class="btn btn-dark btn-sm">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </span>
        </div>
    </x-slot>
        <div class="row">
            <div class="col-md-8">
                <form action="{{route('quiz-result',$quiz->slug)}}" method="post">
                    @csrf
                    <ol class="list-group list-group-numbered">
                        @foreach ($quiz->questions as $question)
                            <li class="list-group-item d-flex justify-content-between align-items-start my-2">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{ $question->question }}</div>
                                    <img src="{{ asset($question->image) }}" class="my-3 img-responsive w-50"
                                        alt="{{ $question->question }}">
                                    {{-- items --}}

                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                            id="quiz_{{ $question->id }}_1" value="answer1" required>
                                        <label class="form-check-label" for="quiz_{{ $question->id }}_1">
                                            {{ $question->answer1 }}
                                        </label>
                                    </div>

                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                            id="quiz_{{ $question->id }}_2" value="answer2" required>
                                        <label class="form-check-label" for="quiz_{{ $question->id }}_2">
                                            {{ $question->answer2 }}
                                        </label>
                                    </div>

                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                            id="quiz_{{ $question->id }}_3" value="answer3" required>
                                        <label class="form-check-label" for="quiz_{{ $question->id }}_3">
                                            {{ $question->answer3 }}
                                        </label>
                                    </div>

                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="radio" name="{{ $question->id }}"
                                            id="quiz_{{ $question->id }}_4" value="answer4" required>
                                        <label class="form-check-label" for="quiz_{{ $question->id }}_4">
                                            {{ $question->answer4 }}
                                        </label>
                                    </div>

                                    {{-- items end --}}
                                </div>
                                <span title="{{ $question->created_at }}"
                                    class="badge bg-primary rounded-pill">?</span>
                            </li>
                        @endforeach
                        <button type="submit" class="btn btn-indigo w-100 mb-2">Quiz'i Bitir</button>
                    </ol>
                </form>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <ul class="list-group">
                        <li class="list-group-item">Diğer Testler</li>
                    </ul>
                </div>
            </div>
        </div>
</x-app-layout>
