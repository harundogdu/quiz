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
        <div class="col-md-9">
            <form action="{{ route('quiz-result', $quiz->slug) }}" method="post">
                @csrf
                <ol class="list-group list-group-numbered font-18">
                    @foreach ($quiz->questions as $question)
                        <li class="list-group-item d-flex justify-content-between align-items-start my-2 p-4">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold font-18">{{ $question->question }}</div>
                                @if ($question->image)
                                    <img src="{{ asset($question->image) }}" class="my-3 img-responsive w-75"
                                        alt="{{ $question->question }}">
                                @endif
                                {{-- items --}}

                                <div class="form-check my-2 p-0">
                                    <label class="rad-label" for="quiz_{{ $question->id }}_1">
                                        <input class="rad-input" type="radio"
                                            name="{{ $question->id }}" id="quiz_{{ $question->id }}_1"
                                            value="answer1" required>
                                        <div class="rad-design"></div>
                                        <div class="rad-text">{{ $question->answer1 }}</div>
                                    </label>
                                </div>

                                <div class="form-check my-2 p-0">
                                    <label class="rad-label" for="quiz_{{ $question->id }}_2">
                                        <input class="rad-input" type="radio"
                                            name="{{ $question->id }}" id="quiz_{{ $question->id }}_2"
                                            value="answer2" required>
                                        <div class="rad-design"></div>
                                        <div class="rad-text">{{ $question->answer2 }}</div>
                                    </label>
                                </div>

                                <div class="form-check my-2 p-0">
                                    <label class="rad-label" for="quiz_{{ $question->id }}_3">
                                        <input class="rad-input" type="radio"
                                            name="{{ $question->id }}" id="quiz_{{ $question->id }}_3"
                                            value="answer3" required>
                                        <div class="rad-design"></div>
                                        <div class="rad-text">{{ $question->answer3 }}</div>
                                    </label>
                                </div>

                                <div class="form-check my-2 p-0">
                                    <label class="rad-label" for="quiz_{{ $question->id }}_4">
                                        <input class="rad-input" type="radio"
                                            name="{{ $question->id }}" id="quiz_{{ $question->id }}_4"
                                            value="answer4" required>
                                        <div class="rad-design"></div>
                                        <div class="rad-text">{{ $question->answer4 }}</div>
                                    </label>
                                </div>

                                {{-- items end --}}
                            </div>
                            <span title="{{ $question->created_at }}" class="badge bg-warning rounded-pill">?</span>
                        </li>
                    @endforeach
                    <button type="submit" class="btn btn-dark w-100 mb-2">Quiz'i Bitir</button>
                </ol>
            </form>
        </div>
        <div class="col-md-3 mt-2">
                <div class="card">
                    <ul class="list-group">
                        <li class="list-group-item">Reklam Alanı</li>
                    </ul>
                </div>
            </div>
    </div>
</x-app-layout>
