@extends('layouts.body')

@section('title', 'Services')

@section('main')
<main>
    <div class="container-fluid px-4">
        <x-breadcrumb
            title="Services"
            breadcrumb="services/data"
            href="/admin/services/create"
            button="create services" />

        {{-- Data Table --}}
        <x-table class="table table-bordered" title="List of Services">
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
                <div class="d-flex gap-2">
                    <button type="button"
                        class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal"
                    onclick="editModal({{ $service->id }}, '{{ $service->services_name }}', '{{ $service->code }}')">
                    Edit
                    </button>

        {{-- Tombol Hapus --}}
        <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Hapus</button>
        </form>
    </div>
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

    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">

                        <div class="mb-3">
                            <label for="edit_services_name" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="edit_services_name" name="services_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="edit_code" name="code" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="edit_logo" name="logo">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

{{-- Script Modal --}}
<script>
    function editModal(id, name, code) {
        let form = document.getElementById('editForm');
        form.action = '/admin/services/update/' + id; // route update pakai POST

        document.getElementById('edit_id').value = id;
        document.getElementById('edit_services_name').value = name;
        document.getElementById('edit_code').value = code;
    }
</script>
@endsection
