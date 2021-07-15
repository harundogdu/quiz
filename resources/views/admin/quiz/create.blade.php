<x-app-layout>
    <x-slot name="header">
        <div class="clearfix">
            <span class="text-left"><span class="text-danger">Quiz Oluştur</span>
                <span class="text-right float-end">
                    <a href="{{ route('quizzes.index') }}" class="btn btn-dark btn-sm">
                        <i class="fa fa-arrow-left"></i> Geri Dön</a>
                </span>
        </div>
    </x-slot>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('quizzes.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group my-2">
                    <label for="title">Quiz Başlığı<span class="text-danger"> *</span></label>
                    <input type="text"
                        class="form-control appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="title" name="title" placeholder="enter quiz's title" value="{{ old('title') }}">
                </div>
                <div class="form-group my-2">
                    <div class="form-group my-2">
                        <label for="image">Quiz Fotoğrafı</label>
                        <input type="file" name="image" id="image" class="my-2 form-control">
                    </div>
                </div>
                <div class="form-group my-2">
                    <label for="description">Quiz Açıklaması</label>
                    <textarea name="description" id="description" cols="30" rows="5"
                        class="form-control appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="if u want enter quiz's description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group my-2" x-data="{ show: false }">
                    <div class="mb-3">
                        <input @if (old('finished_at')) checked @endif
                            @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }"
                            type="checkbox" name="isFinished" id="isFinished">
                        <label for="isFinished">Quiz Zamanı Olsun Mu?</label>
                    </div>
                    <div @if (old('finished_at')) x-show="true" @else x-show="show" @endif
                        id="finishDiv" class="form-group my-2">
                        <label for="finished_at">Sona Erme Zamanı</label>
                        <input type="datetime-local" name="finished_at" id="finished_at"
                            value="{{ old('finished_at') }}" class="form-control">
                    </div>
                </div>
                <div class="form-group mt-3">
                    <b><small id="helpText" class="text-danger">* Zorunlu Alan</small></b>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-success w-100">Quiz Oluştur</button>
                </div>
            </form>
        </div>
    </div>
    {{-- <x-slot name="js">
        <script type="text/javascript">
            $('#finishDiv').hide();
            $('#isFinished').change(function(e) {
                e.preventDefault();
                if (this.checked) {
                    $('#finishDiv').fadeIn('slow');
                    console.log('sada');
                } else {
                    $('#finishDiv').fadeOut('fast');
                }
            });
        </script>
    </x-slot> --}}
</x-app-layout>
