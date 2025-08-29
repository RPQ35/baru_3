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

            <div class="col-12 gap-3 d-grid" style="height:80vh;width:100%;">
                <!-- a -->
                <div class="row border border-5 border-black-subtle rounded col-12 h-60 max-h-60 card">
                    <div class="card-header">
                        <i class="fas fa-ticket me-1 text-primary"></i>
                        active
                    </div>

                    <div class="card-body row align-item-center" style="overflow-y: scroll; max-height:80%;">
                        {{ $QueuesActive}}
                    </div>
                </div>

                <!-- b & c -->
                <div class=" row rounded   h-70 w-100">

                    <!-- b (This will be a full-width column on small screens) -->
                    <div class="col-12 col-md-5 rounded border border-3 border-dark-subtle card">
                        <div class="card-header">
                            <i class="fas fa-ticket me-1 text-warning"></i>
                            oncoming
                        </div>

                        <div class="card-body" style="overflow-y: scroll; max-height: 80%;">
                            {{ $QueuesComing }}
                        </div>


                    </div>
                    {{-- -------------------- divider ------------------ --}}
                    <div class="col-md-1"></div>
                    {{-- ------------------------------------------------ --}}

                    <div class="col-12 col-md-6 rounded border border-3 border-dark-subtle card">
                        <div class="card-header">
                            <i class="fas fa-ticket me-1 "></i>
                            outcome
                        </div>
                        {{ $QueuesDone }}
                        <div class="card-body" style="overflow-y: scroll; max-height: 80%;">

                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
