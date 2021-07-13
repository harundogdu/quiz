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
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Sona Erme Zamanı
                    <span
                        class="badge bg-indigo rounded-pill">{{ $quiz->finished_at ? $quiz->finished_at->diffForHumans() : 'Sonsuza Kadar' }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Soru Sayısı
                    <span class="badge bg-indigo rounded-pill">{{ $quiz->questions_count }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Ortalama Puan
                    <span class="badge bg-indigo rounded-pill">70</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Katılımcı Sayısı
                    <span class="badge bg-indigo rounded-pill">20</span>
                </li>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="card w-100" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="display-6 font-32">{{ $quiz->title }}</h5>
                    <p class="lead my-3 font-18">{{ $quiz->description }}</p>
                    <a href="{{route('quiz-join',$quiz->slug)}}" class="btn btn-indigo w-100 mt-3">Quiz'e Katıl</a>
                </div>
            </div>
        </div>
    </div>
    {{-- list end --}}
</x-app-layout>
