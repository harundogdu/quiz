<x-app-layout>
    <x-slot name="header">
        {{ __('Son Quizler') }}
    </x-slot>
    {{-- list --}}
    <section class="">
        <div class="container py-2">
            <div class="row">
                <div class="col-md-9">
                    @foreach ($quizzes as $quiz)
                        @if ($quiz->finished_at > now() || $quiz->finished_at == null)
                            <article class="postcard light blue shadow">
                                <a class="postcard__img_link" href="{{ route('quiz-details', $quiz->slug) }}">
                                    <img class="postcard__img" src="{{$quiz->image}}"
                                        alt="Image Title" />
                                </a>
                                <div class="postcard__text t-dark">
                                    <h1 class="postcard__title blue"><a
                                            href="{{ route('quiz-details', $quiz->slug) }}">{{ $quiz->title }}</a>
                                    </h1>
                                    <div class="postcard__subtitle small">
                                        @if ($quiz->finished_at > now() || $quiz->finished_at != null)
                                            <time datetime="{{ $quiz->finished_at }}">
                                                <i class="fas fa-calendar-alt mr-2"></i>
                                                {{ $quiz->finished_at ? $quiz->finished_at->diffForHumans() . ' sona eriyor' : null }}
                                            </time>
                                        @endif
                                    </div>
                                    <div class="postcard__bar"></div>
                                    <div class="postcard__preview-txt">
                                        {{ Str::limit($quiz->description, 200, '...') }}</div>
                                    <ul class="postcard__tagbox">
                                        <li title="Tavsiye Edilen Okuma Süresi" class="tag__item"><i
                                                class="fas fa-clock mr-2"></i>{{ round(($quiz->questions_count * 30) / 60) }}
                                            dakika</li>
                                        <li class="tag__item play blue">
                                            <a href="{{ route('quiz-details', $quiz->slug) }}"><i
                                                    class="fas fa-play mr-2"></i>Testi Başlat</a>
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        @endif
                    @endforeach
                    <div class="mt-3">
                        {{ $quizzes->links() }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="postcard light red d-flex justify-content-center align-items-center flex-column shadow">
                        <div class="sub-text card-title h4 text-dark mt-3 my-2">Quiz Sonuçları</div>
                        @if ($results)
                            <div class="card-text text-dark p-2 font-18">
                                <ul class="list-group">
                                    @foreach ($results as $result)
                                        <li style="background: transparent !important; border:none;"
                                            class="list-group-item">
                                            <strong>{{ $result->point }}</strong> -
                                            <a
                                                href="{{ route('quiz-details', $result->quiz->slug) }}">{{ $result->quiz->title }}</a>
                                        </li>
                                        @if (!$loop->last)
                                            <hr>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </section>
    {{-- list end --}}
</x-app-layout>
