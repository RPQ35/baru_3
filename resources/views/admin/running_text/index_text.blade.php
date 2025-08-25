@extends('layouts.body')
@section('title', 'running text')
@section('main')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Running Text</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Running Text</li>
        </ol>

        {{-- Running text tampil --}}
       @if($data)
    <div class="alert alert-secondary text-start">
        {{ $data }}
    </div>
@endif

        {{-- Panggil component (popup modal) --}}
        <x-modal-form route="{{ route('running_text.store') }}" :data="$data" />

    </div>
</main>
@endsection
