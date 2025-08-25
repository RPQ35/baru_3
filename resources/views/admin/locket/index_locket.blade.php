@extends('layouts.body')
@section('title', 'admin locket')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Locket</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">locket/data</li>
            </ol>
            {{-- data table --}}
            <x-table>
                {{-- |==slot untuk thead table==| --}}
                <x-slot name="thead">
                </x-slot>

                {{-- |==slot untuk body table==| --}}
                <x-slot name="tbody">
                </x-slot>
            </x-table>
            {{-- =========== --}}


            
            {{-- form --}}
            {{-- <x-form>
                <x-form-input></x-form-input>
            </x-form> --}}
            {{-- ========== --}}
        </div>
    </main>
@endsection
