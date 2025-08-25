@extends('layouts.body')
@section('title', 'admin account')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Account</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            {{-- data table --}}
            <x-table title='title'>
                <x-slot name="thead">
                </x-slot>

                <x-slot name="tbody">
                </x-slot>
            </x-table>
            {{-- =========== --}}
        </div>
    </main>
@endsection
