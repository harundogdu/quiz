<x-app-layout>
    <x-slot name="header"><span class="text-danger">{{ $quiz->title }}</span> 'e ait sorular</x-slot>
    <div class="card">
        <div class="card-body">
            <a href="{{ route('quizzes.create') }}" class="btn btn-sm btn-primary mb-3"><i
                    class="fa fa-plus mr-2"></i>Soru Oluştur</a>
            <p class="lead">Quiz Sorusu Oluşturmak İçin Gerekli Olan Sayfa.</p>
            <table class="table table-bordered my-2">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Soru</th>                        
                        <th>Cevap 1</th>
                        <th>Cevap 2</th>
                        <th>Cevap 3</th>
                        <th>Cevap 4</th>
                        <th>Doğru Cevap</th>
                        <th width="100">Soru Eylemleri</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($quiz)
                        @foreach ($quiz->questions as $question)
                            <tr>                                
                                <td style="text-align: center" width="200">
                                    @isset($question->image)
                                        <img class="img-fluid" src="{{ $question->image }}" alt="">
                                    @else
                                        <span class="font-weight-bolder">&times;</span>
                                    @endisset
                                </td>
                                <td class="text-danger">{{ $question->question }}</td>
                                <td>
                                    {{ $question->answer1 }}</td>
                                <td>
                                    {{ $question->answer2 }}</td>
                                <td>
                                    {{ $question->answer3 }}</td>
                                <td>
                                    {{ $question->answer4 }}</td>
                                <td class="text-success">Cevap {{ substr($question->correct_answer, -1) }}
                                </td>
                                <td class="clearfix">
                                    <a style="float:left;"
                                        href="{{ route('questions.edit', [$quiz->id, $question->id]) }}"
                                        class="mx-1 btn btn-sm btn-secondary" title="Edit Quiz">
                                        <i class="text-white fa fa-pen"></i>
                                    </a>
                                    <form style="float:left;"
                                        action="{{ route('questions.destroy', [$quiz->id, $question->id]) }}"
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
            {{-- {{ $quizzes->links() }} --}}
        </div>
    </div>
</x-app-layout>
