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
                <div class="row border border-5 border-black-subtle rounded col-12 h-60">
                </div>

                <!-- b & c -->
                <div class=" row rounded   h-70 w-100">

                    <!-- b (This will be a full-width column on small screens) -->
                    <div class="col-12 col-md-5 rounded border border-3 border-dark-subtle card">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            oncoming
                        </div>

                        <div class="card-body">
                            tes
                        </div>


                    </div>
                    {{---------------------- divider --------------------}}
                    <div class="col-md-1"></div>
                    {{----------------------------------------------------}}

                    <div class="col-12 col-md-6 rounded border border-3 border-dark-subtle card">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            outcome
                        </div>

                        <div class="card-body">
                            tes
                        </div>
                </div>
            </div>
        </div>
    </main>
@endsection
