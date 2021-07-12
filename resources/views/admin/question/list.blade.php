<x-app-layout>
    <x-slot name="header">
        <div class="clearfix">
            <span class="float-start"><a class="text-danger"
                    href="{{ route('questions.index', $quiz->id) }}">{{ $quiz->title }}</a></span>
            <span class="float-end"><a href="{{ route('quizzes.index') }}" class="btn btn-dark btn-sm"><i
                        class="fa fa-arrow-left"></i> Geri Dön</a></span>
        </div>
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="text-right">
                <a href="{{ route('questions.create', $quiz->id) }}" class="btn btn-sm btn-primary mb-3"><i
                        class="fa fa-plus mr-2"></i>Soru Oluştur</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered my-2 text-center">
                <thead class="bg-indigo">
                    <tr>
                        <th class="text-white">Fotoğraf</th>
                        <th class="text-white">Soru</th>
                        <th class="text-white">Cevap 1</th>
                        <th class="text-white">Cevap 2</th>
                        <th class="text-white">Cevap 3</th>
                        <th class="text-white">Cevap 4</th>
                        <th class="text-white" width="125">Doğru Cevap</th>
                        <th class="text-white" width="150">Soru Eylemleri</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($quiz)
                        @if ($quiz['questions']->count() > 0)
                            @foreach ($quiz->questions as $question)
                                <tr>
                                    <td style="text-align: center" width="200">
                                        @isset($question->image)
                                            <img class="img-fluid" src="{{ asset($question->image) }}" alt="">
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
                                            class="mx-1 btn btn-sm btn-secondary" title="Edit Question">
                                            <i class="text-white fa fa-pen"></i>
                                        </a>
                                        <form style="float:left;"
                                            action="{{ route('questions.destroy', [$quiz->id, $question->id]) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="mx-1 btn btn-sm btn-danger" title="Delete Question">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-warning text-center">Veri Bulunamadı</div>
                                </td>
                            </tr>
                        @endif
                    @endif
                </tbody>
            </table>
            {{-- {{ $quizzes->links() }} --}}
        </div>
        <div class="card-footer">
            <small class="text-muted">Quiz Sorusu Oluşturma Ekranı</small>
        </div>
    </div>
</x-app-layout>
