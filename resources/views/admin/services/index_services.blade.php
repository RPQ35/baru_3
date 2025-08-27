@extends('layouts.body')

@section('title', 'Services')

@section('main')
<main>
    <div class="container-fluid px-4">
        <div class="container-fluid px-4">
            <x-breadcrumb   title="services"
                            breadcrumb="services/data"
                            href="/admin/services/create"
                            button="create services"></x-breadcrumb>

            {{-- data table --}}

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <x-table class="table table-bordered">
             <x-slot name="thead">
                    <tr>
                        <th>No</th>
                        <th>Service Name</th>
                        <th>Code</th>
                        <th>Logo</th>
                        <th>Action</th>
                    </tr>
                </x-slot>
            <x-slot name="tbody">
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
            </x-slot>
        </x-table>
    </div>
</main>
@endsection
