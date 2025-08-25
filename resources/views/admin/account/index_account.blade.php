@extends('layouts.body')
@section('title', 'admin account')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb   title="Locket"
            breadcrumb="account/data"
            href="/admin/account/create"
            button="create account"></x-breadcrumb>

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
