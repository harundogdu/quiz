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
                        <th>Quiz Oluşturulma Tarihi</th>
                        <th>Quiz Sona Erme Tarihi</th>
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
                                <td>{{$value->created_at->diffForHumans()}}</td>
                                <td>
                                    @if ($value->finished_at !== null)
                                        <b>{{ $value->finished_at }}</b>
                                    @else
                                        <span>Sona Erme Tarihi Yok</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('quizzes.destroy', $value->id) }}" class="btn btn-sm btn-danger"
                                        title="Delete Quiz">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <a href="{{ route('quizzes.edit', $value->id) }}" class="btn btn-sm btn-secondary"
                                        title="Edit Quiz">
                                        <i class="text-white fa fa-pen"></i>
                                    </a>
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
