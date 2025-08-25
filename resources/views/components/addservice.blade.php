@extends('layouts.body')

@section('title', 'Add Service')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add Service</h1>

        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="services_name" class="form-label">Service Name</label>
                <input type="text" name="services_name" class="form-control" value="{{ old('services_name') }}">
                @error('services_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                @error('code') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" name="logo" class="form-control">
                @error('logo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</main>
@endsection
