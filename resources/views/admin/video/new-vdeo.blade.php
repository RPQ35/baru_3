@extends('layouts.body')

@section('title', 'Add Service')

@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Services" breadcrumb="video/create" href="/admin/video" button="back"></x-breadcrumb>


            <x-form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-form-input name="title" type="text" title="Title">
                </x-form-input>

                <x-form-input title="" name="video" type="file" div_Id="parents"
                    onchange="video_temp(this)"></x-form-input>


            </x-form>
    </main>

    <script src="{{ asset('js/tempVideo.js') }}"></script>

@endsection
