@extends('layouts.body')
@section('title', 'admin locket')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Locket</h1>
            <ol class="breadcrumb mb-4 d-flex justify-content-between">
                <li class="breadcrumb-item active  ">locket/create</li>
                <button type="button" class="btn btn-primary " onclick="window.location.href='/admin/locket';">back</button>

            </ol>
            {{-- form --}}
            <x-form method="POST" route="{{ route('admin.locket.store') }}">
                <x-form-input name="name"></x-form-input>

                @foreach ($services_list as $item)
                    @if ($loop->iteration % 2 == 1)
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @endif

                    <input type="checkbox" class="btn-check" id="{{ $item->services_name }}" name="services[]" autocomplete="off" value="{{ $item->id }}">
                    <label class="btn btn-outline-primary"
                        for="{{ $item->services_name }}">{{ $item->services_name }}</label>
                    @if ($loop->iteration % 2 == 0 || $loop->last)
                    </div>
                    @endif
        @endforeach


        </x-form>



        {{-- ========== --}}
        </div>
    </main>
@endsection
