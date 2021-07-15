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
        <div class="col-md-12">
            <form action="{{ route('quiz-result', $quiz->slug) }}" method="post">
                @csrf
                <ol class="list-group">
                    <div class="alert alert-warning">
                        <p class="h4">Puanınız : <strong>{{ $quiz->my_results->point }}</strong></p>
                        <span class="mr-2"><i class="fa fa-check text-success"></i> Doğru</span>
                        <span class="mx-2"><i class="fa fa-times text-danger"></i> Yanlış</span>
                        <span class="ml-2"><i class="fa fa-circle text-purple"></i> Seçiminiz</span>
                    </div>
                    @foreach ($quiz->questions as $question)
                        <li class="list-group-item d-flex justify-content-between align-items-start my-2">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">
                                    @if ($question->correct_answer === $question->my_answer->answer)
                                        <i class="fa fa-check text-success"></i>
                                    @else
                                        <i class="fa fa-times text-danger"></i>
                                    @endif
                                    {{ $loop->iteration }}-{{ $question->question }}
                                </div>
                                @if($question->image)
                                <img src="{{ asset($question->image) }}" class="my-3 img-responsive w-50"
                                alt="{{ $question->question }}">
                                @endif
                                {{-- items --}}

                                <div class="form-check my-2">
                                    @if ($question->correct_answer === 'answer1')
                                        <i class="fa fa-check text-success"></i>
                                    @elseif($question->my_answer->answer == 'answer1')
                                        <i class="fa fa-circle text-purple"></i>
                                    @endif
                                    <label class="form-check-label" for="quiz_{{ $question->id }}_1">
                                        {{ $question->answer1 }}
                                    </label>
                                </div>

                                <div class="form-check my-2">
                                    @if ($question->correct_answer === 'answer2')
                                        <i class="fa fa-check text-success"></i>
                                    @elseif($question->my_answer->answer == 'answer2')
                                        <i class="fa fa-circle text-purple"></i>
                                    @endif
                                    <label class="form-check-label" for="quiz_{{ $question->id }}_2">
                                        {{ $question->answer2 }}
                                    </label>
                                </div>

                                <div class="form-check my-2">
                                    @if ($question->correct_answer === 'answer3')
                                        <i class="fa fa-check text-success"></i>
                                    @elseif($question->my_answer->answer == 'answer3')
                                        <i class="fa fa-circle text-purple"></i>
                                    @endif
                                    <label class="form-check-label" for="quiz_{{ $question->id }}_3">
                                        {{ $question->answer3 }}
                                    </label>
                                </div>

                                <div class="form-check my-2">
                                    @if ($question->correct_answer === 'answer4')
                                        <i class="fa fa-check text-success"></i>
                                    @elseif($question->my_answer->answer == 'answer4')
                                        <i class="fa fa-circle text-purple"></i>
                                    @endif
                                    <label class="form-check-label" for="quiz_{{ $question->id }}_4">
                                        {{ $question->answer4 }}
                                    </label>
                                </div>
                                <small class="text-muted">Katılanların <strong>%{{$question->true_percent}}</strong>'i Doğru Cevapladı</small>
                                {{-- items end --}}
                            </div>
                            <span title="{{ $question->created_at }}" class="badge bg-primary rounded-pill">?</span>
                        </li>
                    @endforeach
                </ol>
            </form>
        </div>
        {{-- <div class="col-md-4">
            <div class="card">
                <ul class="list-group">
                    <li class="list-group-item">Diğer Testler</li>
                </ul>
            </div>
        </div> --}}
    </div>
</x-app-layout>
