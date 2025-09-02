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
                    <x-form-input title="Update Video" name="video" type="file"></x-form-input>

                    <x-slot name="footer">
                        <x-modal-foot-button />
                </form>
                </x-slot>
            </x-NewModal>


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
