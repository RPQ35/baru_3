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

                <x-form-input name="logo" title="Logo" type="file" onchange="logo_temp(this)">
                    @error('logo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </x-form-input>


            </x-form>
        </div>
    </main>
    <script>
        function logo_temp(obj) {
            const file = obj.files[0];
            const formData = new FormData();
            formData.append('logo', file);

            fetch('/admin/services/logo', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.url);

                    var images = document.createElement('img');
                    images.style="max-height:100px;";
                    images.src = data.url;

                    obj.replaceWith(images);

                })
                .catch(error => console.error('Error:', error));
        };
    </script>
@endsection
