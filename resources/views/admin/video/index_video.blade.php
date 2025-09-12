@extends('layouts.body')
@section('head')
@endsection
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


            <x-breadcrumb title="video" breadcrumb="video" href="/admin/video/create" button="tambah video +"></x-breadcrumb>

            {{-- tampilan --}}
            @forelse ($videos as $video)
                <x-card size="12" footer="false" bgcolor="bg-white" text="text-black  align-items-center" title="">
                    <div class="d-flex flex-row col-12  justify-content-between" style="max-width: 100%">
                        <div class="d-flex flex-row ">
                            <video src="{{ $video->file_path }}" onclick="tester(this)" class="col-5 col-xl-2"></video>

                            <div class="d-flex flex-row col-6 justify-content-between">
                                <h4 style="margin-left: 15px">
                                    {{ $video->title }}
                                </h4>

                                <div class="d-flex flex-row">
                                    <x-switch condition="{{ $video->status }}" onchange="status(this)"
                                        value="{{ $video->id }}" name="{{ $video->title }}" />
                                </div>
                                <div class="col-5 d-flex flex-row justify-content-end ">
                                    <i class="invisible fa-solid fa-minimize " onclick="minimize(this)"></i>
                                    {{-- this <i> is auto generate a <svg> --}}
                                </div>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-primary btn-lg " funct="OpenModal" onclick="otwUpdate(this)"
                                data-value="{{ $video->title }}" value="{{ $video->id }}">
                                Edit Video
                            </button>
                        </div>
                    </div>
                </x-card>
            @empty
            @endforelse



            {{-- Panggil component (popup modal) --}}
            <x-NewModal potition="center" title="Update Video">
                <form action="{{ route('video.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="ids">

                    <x-form-input title="Title" name="title" />

                    <x-form-input title="" name="video" type="file" div_Id="parents"
                        onchange="video_temp(this)"></x-form-input>

                    <x-slot name="footer">
                        <x-modal-foot-button id="subm" />
                </form>
                </x-slot>
            </x-NewModal>


        </div>
    </main>
@endsection




<script>
    function otwUpdate(ids) {
        document.getElementById('ids').value = ids.value;
        document.getElementById('title').value = ids.getAttribute('data-value');
    }

    document.addEventListener('DOMContentLoaded', function() {
        var toastElement = document.querySelector('.toast');
        if (toastElement) {
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        }
    });
</script>

<script>
    function status(objec) {
        const formData = new FormData();
        var status = 0;
        var ids = objec.value;

        if (objec.checked) {
            status = 1;
        } else {
            status = 0;
        }

        formData.append('id', ids);
        formData.append('status', status);

        fetch('/admin/video/status', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {})
            .catch(error => console.error('Error:', error));
    }
</script>

<script src="{{ asset('js/videocard.js') }}"></script>
<script src="{{ asset('js/tempVideo.js') }}"></script>
