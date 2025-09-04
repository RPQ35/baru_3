@if (session('locket'))
@else
    <script>
        window.location.href = "/lockets/select";
    </script>
@endif
@extends('layouts.body')
@section('main')
    <main>

        <div class="container-fluid px-4">
            <x-breadcrumb title="Locket" breadcrumb="locket/app" href="" button="false"></x-breadcrumb>

            <div class="col-12 gap-3 d-grid w-100" style="height:80vh;">
                <!-- a -->
                <div class="col-12  rounded border border-3 border-dark-subtle card w-100" style="height:12.2rem;">
                    <div class="card-header">
                        <i class="fas fa-ticket me-1 text-primary"></i>
                        active
                    </div>

                    @livewire('locket-active')
                </div>

                <div class=" row rounded  w-100">

                    <div class="col-12 col-md-5 rounded border border-3 border-dark-subtle card" style=" height: 20rem;">
                        <div class="card-header">
                            <i class="fas fa-ticket me-1 text-warning"></i>
                            oncoming
                        </div>

                        @livewire('locket-oncoming')


                    </div>
                    {{-- -------------------- divider ------------------ --}}
                    <div class="col-md-1"></div>
                    {{-- ------------------------------------------------ --}}

                    <div class="col-12 col-md-6 rounded border border-3 border-dark-subtle card" style="height: 20rem;">
                        <div class="card-header">
                            <i class="fas fa-ticket me-1 "></i>
                            outcome
                        </div>
                        @livewire('locket-out-come')
                    </div>
                </div>
            </div>
    </main>
@endsection
