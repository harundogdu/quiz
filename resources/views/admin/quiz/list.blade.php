<x-app-layout>
    <x-slot name="header">Quizler</x-slot>
    <div class="card">
        <div class="card-body">
            <a href="{{ route('quizzes.create') }}" class="btn btn-sm btn-primary mb-3"><i
                    class="fa fa-plus mr-2"></i>Quiz Oluştur</a>
            <p class="lead">Quiz Oluşturmak İçin Gerekli Olan Sayfa.</p>
            <table class="table table-bordered my-2 text-center">
                <thead class="bg-indigo">
                    <tr>
                        <th class="text-white">Quiz Adı</th>
                        <th class="text-white">Quiz Durumu</th>
                        <th class="text-white">Soru Sayısı</th>
                        <th class="text-white">Quiz Son İşlem Zamanı</th>
                        <th class="text-white">Quiz Sona Erme Zamanı</th>
                        <th class="text-white">Quiz Eylemleri</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($quizzes)
                        @foreach ($quizzes as $key => $value)
                            <tr>
                                <td><b>{{ $value->title }}</b></td>
                                <td class="text-center">
                                    @php
                                        $textErr = '';
                                        $textMessage = '';
                                        if ($value->status === 'draft') {
                                            $textErr = 'bg-warning text-dark';
                                            $textMessage = 'Taslak';
                                        } elseif ($value->status === 'published') {
                                            $textErr = 'bg-success';
                                            $textMessage = 'Aktif';
                                        } else {
                                            $textErr = 'bg-danger';
                                            $textMessage = 'Pasif';
                                        }
                                        
                                    @endphp
                                    <span class="badge rounded-pill {{ $textErr }}">{{ $textMessage }}</span>
                                </td>
                                <td>{{ $value->questions_count }}</td>
                                <td><span
                                        title="{{ $value->updated_at }}">{{ $value->updated_at->diffForHumans() }}</span>
                                </td>
                                <td>
                                    @if ($value->finished_at !== null)
                                        <b
                                            title="{{ $value->finished_at }}">{{ $value->finished_at->diffForHumans() }}</b>
                                    @else
                                        <span>Sona Erme Tarihi Yok</span>
                                    @endif
                                </td>
                                <td class="clearfix">
                                    <a style="float:left;" href="{{ route('questions.index', $value->id) }}"
                                        class="mx-1 btn btn-sm btn-info" title="Edit Questions">
                                        <i class="text-white fa fa-question"></i>
                                    </a>
                                    <a style="float:left;" href="{{ route('quizzes.edit', $value->id) }}"
                                        class="mx-1 btn btn-sm btn-dark" title="Edit Quiz">
                                        <i class="text-white fa fa-pen"></i>
                                    </a>
                                    <form style="float:left;" action="{{ route('quizzes.destroy', $value->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="mx-1 btn btn-sm btn-danger" title="Delete Quiz">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $quizzes->links() }}
        </div>
    </div>
</x-app-layout>
