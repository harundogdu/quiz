<x-app-layout>
    <x-slot name="header">
        <div class="clearfix">
            <span class="text-left"><span class="text-danger">Quiz Düzenle</span>
                <span class="text-right float-end">
                    <a href="{{ route('quizzes.index') }}" class="btn btn-dark">
                        <i class="fa fa-arrow-left"></i> Geri Dön</a>
                </span>
        </div>
    </x-slot>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('quizzes.update', $quiz->id) }}" method="post">
                @method('put')
                @csrf
                <div class="form-group my-2">
                    <label for="title">Quiz Başlığı<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="enter quiz's title"
                        value="{{ $quiz->title }}">
                </div>
                <div class="form-group my-2">
                    <label for="description">Quiz Açıklaması</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                        placeholder="if u want enter quiz's description">{{ $quiz->description }}</textarea>
                </div>
                <div class="form-group my-2" @if ($quiz->finished_at) x-data="{ show: true }" @else  x-data="{ show: false }" @endif>
                    <div class="mb-3">
                        <input @if ($quiz->finished_at) checked @endif
                            @if (old('finished_at')) checked @endif @click="show =
                        !show" :aria-expanded="show ? 'true' : 'false'"
                        :class="{ 'active': show }" type="checkbox" name="isFinished" id="isFinished">
                        <label for="isFinished">Quiz Zamanı Olsun Mu?</label>
                    </div>
                    <div @if (old('finished_at')) x-show="true" @else x-show="show" @endif
                        id="finishDiv" class="form-group my-2">
                        <label for="finished_at">Sona Erme Zamanı</label>
                        <input @if ($quiz->finished_at) value="{{ date('Y-m-d\TH:i', strtotime($quiz->finished_at)) }}" @endif type="datetime-local" name="finished_at" id="finished_at"
                            value="{{ old('finished_at') }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Quiz Durumu</label>
                    <select name="status" id="status" class="form-control">
                        <option @if ($quiz->questions_count < 4) disabled @endif @if ($quiz->status === 'published')
                            selected @endif value="published">Aktif</option>
                        <option @if ($quiz->status === 'passive') selected @endif value="passive">Pasif</option>
                        <option @if ($quiz->status === 'draft') selected @endif value="draft">Taslak</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <b><small id="helpText" class="text-danger">* Zorunlu Alan</small></b>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-indigo w-100">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
