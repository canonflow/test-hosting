<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(session()->has('success'))
                    <div role="alert" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ session()->get('success') }}</span>
                    </div>
                @endif
                @error('post')
                    <div role="alert" class="alert alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
                <div class="p-6">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="fileUploadForm">
                        @csrf
                        <input type="file" class="file-input file-input-bordered w-full max-w-xs" name="post"/>
                        <button class="btn btn-primary text-white" type="submit">Submit</button>

                        <div class="mt-5">
                            <progress class="progress progress-error w-56" value="0" max="100" id="progress"></progress>
                        </div>
                    </form>
                </div>
                <div class="p-6 text-gray-900">
                    @foreach($posts as $post)
                        {{-- <p>{{ $post['url'] }}</p> --}}
                        {{-- <img src="/{{ $post['url'] }}" alt="kosong"> --}}
                        <img src="{{  asset('/' . $post['url']) }}" alt="kosong">
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        $(function () {
            $(document).ready(function () {
                let progress = document.getElementById('progress');
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                        progress.value = percentage;
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        // $('.progress .progress-bar').css("width", percentage+'%', function() {
                        //   return $(this).attr("aria-valuenow", percentage) + "%";
                        // })
                        progress.value = percentComplete;
                    },
                    success: function (xhr) {
                        alert("FIle has uploaded");
                        console.log('File has uploaded');
                    },
                    error: function(xhr) {
                        alert("Gagal!");
                        console.log("ERROR");
                        console.log(xhr);
                    },
                    complete: function(xhr) {
                        progress.value = 0;
                    },
                    clearForm: true,
                });
            });
        });
    </script>
</x-app-layout>