@extends('layouts.body')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            {{-- card --}}
            {{-- <x-card-parent></x-card-parent> --}}
            {{-- ============= --}}

            {{-- chart --}}
            {{-- <x-chart-sb></x-chart-sb> --}}
            {{-- ============ --}}

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
