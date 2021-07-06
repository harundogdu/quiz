<x-app-layout>
    <x-slot name="header">Quiz Oluştur</x-slot>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('quizzes.store') }}" method="post">
                @csrf
                <div class="form-group my-2">
                    <label for="title">Quiz Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required
                        placeholder="enter quiz's title">
                </div>
                <div class="form-group my-2">
                    <label for="description">Quiz Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                        placeholder="Enter quiz's description"></textarea>
                </div>
                <div class="form-group my-2">
                    <input class="form-checkbox" type="checkbox" name="isFinished" id="isFinished">
                    <label for="isFinished">Sonlu Olsun</label>
                </div>
                <div id="finishDiv" class="form-group my-2">
                    <label for="finished_at">Sona Erme Zamanı</label>
                    <input type="datetime-local" name="finished_at" id="finished_at" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <small id="helpText" class="text-danger">* Required Field</small>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-success w-100">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script type="text/javascript">
            $('#finishDiv').hide();
            $('#isFinished').change(function(e) {
                e.preventDefault();
                if (this.checked) {
                    $('#finishDiv').fadeIn('slow');
                    console.log('sada');
                } else {
                    $('#finishDiv').fadeOut('slow');
                }
            });
        </script>
    </x-slot>
</x-app-layout>
