@extends('layouts.body')
@section('title', 'admin account')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Dashboard" breadcrumb="Dashboard/data" href="" button="false"></x-breadcrumb>


            {{-- card --}}


            <div class="row">
                <x-card bgcolor="bg-danger" href="/admin/account" title="Account" size='4'>
                    <big>{{ $Account }}</big>
                </x-card>
                <x-card bgcolor="bg-primary" href="/admin/locket" title="Locket" size="4">
                    <big>{{ $Locket }}</big>
                </x-card>
                <x-card bgcolor="bg-warning" href="/admin/services" title="Service" size="4">
                    <big>{{ $Service }}</big>
                </x-card>

                <x-card bgcolor="bg-success" href="" title="Que this week" footer="false">
                    <big>{{ $WeekQue }}</big>
                </x-card>
                <x-card bgcolor="bg-secondary" href="" title="Que Today" footer="false">
                    <big>{{ $TodayQue }}</big>
                </x-card>
            </div>

            {{-- ============= --}}

        </div>
    </main>
@endsection
