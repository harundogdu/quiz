<x-app-layout>
    <x-slot name="header">Quizler</x-slot>
    <div class="card">
        <div class="card-header">
            <form method="get">
                <div class="row">
                    <div class="col-md-2">
                        <input name="title" type="text" class="form-control" value="{{ request()->get('title') }}"
                            placeholder="Quiz Adı">
                    </div>
                    <div class="col-md-2">
                        <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Lütfen Seçiniz</option>
                            <option @if (request()->get('status') === 'published') selected="selected" @endif value="published">Aktif
                            </option>
                            <option @if (request()->get('status') === 'passive') selected="selected" @endif value="passive">Pasif
                            </option>
                            <option @if (request()->get('status') === 'draft') selected="selected" @endif value="draft">Taslak
                            </option>
                        </select>
                    </div>
                    @if (request()->get('title') || request()->get('status'))
                        <div class="col-md-2">
                            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Sıfırla</a>
                        </div>
                    @endif
                    <div class="col text-right">
                        <a href="{{ route('quizzes.create') }}" class="btn btn-sm btn-primary mb-3">
                            <i class="fa fa-plus mr-2"></i>Quiz Oluştur
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered my-2 text-center">
                <thead class="text-dark">
                    <tr>
                        <th class="text-dark">Quiz Fotoğrafı</th>
                        <th class="text-dark">Quiz Adı</th>
                        <th class="text-dark">Quiz Durumu</th>
                        <th class="text-dark">Soru Sayısı</th>
                        <th class="text-dark">Quiz Son İşlem Zamanı</th>
                        <th class="text-dark">Quiz Sona Erme Zamanı</th>
                        <th width="200" class="text-dark">Quiz Eylemleri</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($quizzes)
                        @foreach ($quizzes as $key => $value)
                            <tr>
                                <td><img src="{{ asset($value->image) }}" class="img-responsive" alt=""></td>
                                <td width="400"><b>{{ $value->title }}</b></td>
                                <td class="text-center">
                                    @php
                                        $textErr = '';
                                        $textMessage = '';
                                        if ($value->status === 'draft') {
                                            $textErr = 'bg-warning text-dark';
                                            $textMessage = 'Taslak';
                                        } elseif ($value->status === 'published') {
                                            if ($value->finished_at < now() && $value->finished_at != null) {
                                                $textErr = 'bg-indigo';
                                                $textMessage = 'Süresi Doldu';
                                            } else {
                                                $textErr = 'bg-success';
                                                $textMessage = 'Aktif';
                                            }
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
                                    <a style="float:left;" href="{{ route('quizzes.show', $value->id) }}"
                                        class="mx-1 btn btn-sm btn-warning" title="Show Quiz Details">
                                        <i class="text-white fa fa-info"></i>
                                    </a>
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
            {{ $quizzes->withQueryString()->links() }}
        </div>
        <div class="card-footer">
            <small class="text-muted">Quiz Oluşturma Ekranı</small>
        </div>
    </div>
</x-app-layout>
