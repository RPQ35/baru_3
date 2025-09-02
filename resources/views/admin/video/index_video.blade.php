@extends('layouts.body')
@section('main')
    <main>

        @if (session('success'))
            <x-toast>
                @if (session('success') == 'success')
                    <p class="text-success">Video uploaded!</p>
                @else
                    <p class="text-danger">{{ session('success') }}</p>
                @endif
            </x-toast>
        @endif
        <div class="container-fluid px-4">


            <x-breadcrumb title="video" breadcrumb="video" href="" button="false"></x-breadcrumb>

            {{-- tampilan --}}
            @if ($video)
                <x-card size="8" footer="false" bgcolor="bg-white" text="text-black  align-items-center" title="">

                    <video src="{{ $video->file_path }}" controls class="w-100 w-xl-75"></video>

                </x-card>
            @endif

            <button class="btn btn-primary btn-lg" funct="OpenModal">
                Edit Video
            </button>
            <br>
            <br>
            <br>

            {{-- Panggil component (popup modal) --}}
            <x-NewModal potition="center">
                <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <x-form-input title="Update Video" name="video" type="file"
                        onchange="video_temp(this)"></x-form-input>

                    <x-slot name="footer">
                        <x-modal-foot-button disabled id="subm" />
                </form>
                </x-slot>
            </x-NewModal>


        </div>
    </main>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {

        var toastElement = document.querySelector('.toast');
        if (toastElement) {
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        }
    });

    function video_temp(obj) {
        const file = obj.files[0];
        const formData = new FormData();
        formData.append('video', file);

        fetch('/admin/video/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                // console.log(data.path);
                document.getElementById('subm').disabled = false;

                var videos = document.createElement('video');
                videos.className = "w-100 w-xl-75";
                videos.src = data.path;
                videos.controls=true;

                obj.replaceWith(videos);

            })
            .catch(error => console.error('Error:', error));
    };
</script>
{{-- /video/temp/ --}}
