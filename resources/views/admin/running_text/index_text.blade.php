@extends('layouts.body')
@section('title', 'running text')
@section('main')

    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Runing Text" breadcrumb="Runinng Text" href="" button="false" />

            {{-- Running text tampil --}}
            @if ($data)
                <x-card size="12" footer="false" bgcolor="bg-white" text="text-black" title="">
                    {{ $data }}
                </x-card>
            @endif
            <button class="btn btn-primary " type="button"  funct="OpenModal">
                Edit Running Text
            </button>
            <br>
            <br>
            <br>

            {{-- Panggil component (popup modal) --}}
            <x-NewModal potition="center">
                <form action="{{ route('running_text.store') }}" method="post">
                    @csrf
                    <textarea name="text" id="modalinp" class="form-control" rows="3" required>{{ $data }}</textarea>

                    <x-slot name="footer">
                    <x-modal-foot-button/>
                </form>
                </x-slot>
                </x-NewModal>

        </div>
    </main>
@endsection
