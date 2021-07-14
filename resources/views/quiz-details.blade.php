<x-app-layout>
    <x-slot name="header">
        <div class="clearfix">
            <span class="float-start">{{ $quiz->title }}</span>
            <span class="float-end">
                <a href="{{ route('dashboard') }}" class="btn btn-dark btn-sm">
                    <i class="fa fa-arrow-left"></i> Geri Dön
                </a>
            </span>
        </div>
    </x-slot>
    {{-- list --}}
    <div class="card p-4">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    @if ($quiz->finished_at !== null)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sona Erme Zamanı
                            <span class="badge bg-indigo rounded-pill">{{ $quiz->finished_at->diffForHumans() }}
                            </span>
                        </li>
                    @endif
                    @if ($quiz->my_results != null)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Puanınız
                            <span class="badge bg-success rounded-pill">{{ $quiz->my_results->point }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Doğru / Yanlış Sayısı
                            <div class="float-right">
                                <span class="badge bg-success rounded-pill">{{ $quiz->my_results->correct }}
                                    Doğru</span>
                                <span class="badge bg-danger rounded-pill">{{ $quiz->my_results->wrong }}
                                    Yanlış</span>
                            </div>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Soru Sayısı
                        <span class="badge bg-indigo rounded-pill">{{ $quiz->questions_count }}</span>
                    </li>
                    @if ($quiz->details)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Ortalama Puan
                            <span class="badge bg-dark rounded-pill">{{ $quiz->details['average'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Katılımcı Sayısı
                            <span class="badge bg-warning rounded-pill">{{ $quiz->details['joinCount'] }}</span>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-8">
                <div class="card w-100" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="display-6 font-32">{{ $quiz->title }}</h5>
                        <p class="lead my-3 font-18">{{ $quiz->description }}</p>
                        @if ($quiz->my_results != null)
                            <a href="#" class="btn btn-danger w-100 mt-3">Quiz'i Görüntüle</a>
                        @else
                            <a href="{{ route('quiz-join', $quiz->slug) }}" class="btn btn-indigo w-100 mt-3">Quiz'e
                                Katıl</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- list end --}}
</x-app-layout>
