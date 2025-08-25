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
                <div class="alert alert-secondary text-start w-75 h-60">
                    <video src="{{ $video->file_path }}" controls class="w-75"></video>
                </div>
            @endif

            {{-- Panggil component (popup modal) --}}
            <x-modal-form title="Edit Video" file="true" name="video" route="{{ route('video.store') }}"
                enctype="multipart/form-data" :data="$video" />


        </div>
    </main>
@endsection

<script>
    // Wait for the document to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Find the toast element
        var toastElement = document.querySelector('.toast');

        // Check if the toast element exists (meaning the session('success') was set)
        if (toastElement) {
            // Create a new Bootstrap Toast instance
            var toast = new bootstrap.Toast(toastElement);

            // Show the toast
            toast.show();
        }
    });
</script>
