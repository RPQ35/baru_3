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
            {{--       <x-chart-sb></x-chart-sb> --}}
            {{-- ============ --}}
            {{-- data table --}}
            {{-- <x-table></x-table> --}}
            {{-- =========== --}}
            <x-form></x-form>
        </div>
    </main>
@endsection
