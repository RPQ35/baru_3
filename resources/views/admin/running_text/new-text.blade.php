@extends('layouts.body')

@section('title', 'Add Service')

@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Crete new Text" breadcrumb="running_text/create" href="/admin/running_text" button="back"></x-breadcrumb>


            <x-form action="{{ route('running_text.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="">
                    <p>masukan teks untuk running text</p>
                    <textarea name="text" id="text-input" class="form-control" rows="3" required></textarea>
                    @error('text')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </label>

            </x-form>
    </main>

    <script src="{{ asset('js/tempVideo.js') }}"></script>

@endsection
