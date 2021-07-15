<x-app-layout>
    <x-slot name="header">
        {{ __('Son Quizler') }}
    </x-slot>
    {{-- list --}}
    <div class="row">
        <div class="col-md-8">
            <div class="list-group">
                @foreach ($quizzes as $quiz)
                    @if ($quiz->finished_at > now() || $quiz->finished_at == null)
                        <a href="{{ route('quiz-details', $quiz->slug) }}"
                            class="list-group-item list-group-item-action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $quiz->title }}</h5>
                                <small>{{ $quiz->finished_at ? $quiz->finished_at->diffForHumans() . ' sona eriyor' : null }}</small>
                            </div>
                            @if ($quiz->description)
                                <p class="mb-1">{{ Str::limit($quiz->description, 100, '...') }}</p>
                            @endif
                            <small>{{ $quiz->questions_count }} Soru</small>
                        </a>
                    @endif
                @endforeach
                <div class="mt-3">
                    {{ $quizzes->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Quiz Sonuçları</div>
                @if ($results)                
                    <div class="card-body">
                        <ul>
                            @foreach ($results as $result)
                                <li><strong>{{ $result->point }}</strong> -
                                    <a href="{{ route('quiz-details', $result->quiz->slug) }}">{{ $result->quiz->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- list end --}}
</x-app-layout>
