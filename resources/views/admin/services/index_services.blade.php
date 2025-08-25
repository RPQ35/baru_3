@extends('layouts.body')

@section('title', 'Services')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Services</h1>
        <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">+ Add Service</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Service Name</th>
                    <th>Code</th>
                    <th>Logo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($servi as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->services_name }}</td>
                        <td>{{ $service->code }}</td>
                        <td>
                            @if($service->logo_path)
                                <img src="{{ asset('storage/'.$service->logo_path) }}" alt="logo" width="50">
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada services</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
@endsection
