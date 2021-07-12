<x-app-layout>
    <x-slot name="header">
        {{ __('Son Quizler') }}
    </x-slot>
    {{-- list --}}
    <div class="row">
        <div class="col-md-9">
            <div class="list-group">
                @foreach ($quizzes as $quiz)
                    <a href="{{ route('quiz-details', $quiz->slug) }}" class="list-group-item list-group-item-action"
                        aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $quiz->title }}</h5>
                            <small>{{ $quiz->finished_at ? $quiz->finished_at->diffForHumans() . ' sona eriyor' : null }}</small>
                        </div>
                        @if ($quiz->description)
                            <p class="mb-1">{{ Str::limit($quiz->description, 100, '...') }}</p>
                        @endif
                        <small>{{ $quiz->questions_count }} Soru</small>
                    </a>
                @endforeach
                <div class="mt-3">
                    {{ $quizzes->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Son Girilen Quizler</div>
                <div class="card-body">
                    <ul>
                        <li><a href="">#86 Futbol Soruları</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- list end --}}
</x-app-layout>
