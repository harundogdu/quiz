<x-app-layout>
    <x-slot name="header">Quizler</x-slot>
    <div class="card">
        <div class="card-body">
            <a href="{{ route('quizzes.create') }}" class="btn btn-sm btn-primary mb-3"><i
                    class="fa fa-plus mr-2"></i>Quiz Oluştur</a>
            <p class="lead">Quiz Oluşturmak İçin Gerekli Olan Sayfa.</p>
            <table class="table table-bordered my-2">
                <thead>
                    <tr>
                        <th>Quiz Adı</th>
                        <th>Quiz Durumu</th>
                        <th>Quiz Son İşlem Zamanı</th>
                        <th>Quiz Sona Erme Zamanı</th>
                        <th>Quiz Eylemleri</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($quizzes)
                        @foreach ($quizzes as $key => $value)
                            <tr>
                                <td>{{ $value->title }}</td>
                                <td>
                                    @php
                                        $textErr = '';
                                        if ($value->status === 'draft') {
                                            $textErr = 'text-primary';
                                        } elseif ($value->status === 'published') {
                                            $textErr = 'text-success';
                                        } else {
                                            $textErr = 'text-danger';
                                        }
                                        
                                    @endphp
                                    <span class="{{ $textErr }}"><b>{{ $value->status }}</b></span>
                                </td>
                                <td>{{ $value->updated_at->diffForHumans() }}</td>
                                <td>
                                    @if ($value->finished_at !== null)
                                        <b>{{ $value->finished_at }}</b>
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
                                        class="mx-1 btn btn-sm btn-secondary" title="Edit Quiz">
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
