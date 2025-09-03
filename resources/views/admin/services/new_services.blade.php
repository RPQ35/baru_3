@extends('layouts.body')

@section('title', 'Add Service')

@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Services" breadcrumb="services/create" href="/admin/services" button="back"></x-breadcrumb>


            <x-form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">

                <x-form-input name="services_name" title="Services name">
                    @error('services_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </x-form-input>

            <x-form-input name="code" title="Code name">
                @error('code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </x-form-input>
            <x-form-input name="input_label" title="Input Label">
             @error('input_label')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            </x-form-input>

                <x-form-input name="logo" title="Logo" type="file" onchange="logo_temp(this)" div_Id="parrents">
                    @error('logo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </x-form-input>


            </x-form>
        </div>
    </main>

       <script src="{{ asset('js/logo_upload.js') }}"></script>

@endsection
