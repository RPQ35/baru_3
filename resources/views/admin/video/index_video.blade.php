@extends('layouts.body')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="video" breadcrumb="video" button="" onclick="opens()" href=''></x-breadcrumb>
        </div>
    </main>
    <script>
        function opens(){
            console.log('a');
        }
    </script>
@endsection
