@extends('layouts.body')

@section('title', 'Services')

@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Services" breadcrumb="services/data" href="/admin/services/create" button="create services" />


            {{-- _____________ data table _________________________ --}}
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
                                @if ($service->logo_path)
                                    <img src="{{ asset('storage/' . $service->logo_path) }}" alt="logo" width="50">
                                @endif
                            </td>
                            <td>

                                {{-- button action --}}
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')

                                    <div class="btn-group">
                                        <button type="button" funct="editmodal" class="btn btn-secondary btn-sm"
                                            value='["{{ $service->id }}","{{ $service->code }}","{{ $service->services_name }}"]'
                                            onclick=" editModal(this)">Edit</button>

                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </form>

                            </td>

                        </tr>
                    @empty
                    @endforelse
                </x-slot>
            </x-table>
        </div>

        {{-- __________________________________________________ --}}

        {{-- _____________Modal for edit ______________________ --}}

        <x-modal-update title="Edit Services" action="{{ route('services.update') }}">

            <input type="hidden" id="edit_id" name="id" value="">

            <div class="mb-3">
                <label for="edit_services_name" class="form-label">Service Name</label>
                <input type="text" class="form-control" id="edit_services_name" name="services_name" value=""
                    required>
            </div>

            <div class="mb-3">
                <label for="edit_code" class="form-label">Code</label>
                <input type="text" class="form-control" id="edit_code" value="" name="code" required>
            </div>

            <div class="mb-3">
                <label for="edit_logo" class="form-label">Logo</label>
                <input type="file" class="form-control" id="edit_logo" name="logo">
            </div>

        </x-modal-update>

    </main>

    {{-- Script Modal --}}
    <script>
        function editModal(datas) {
            datas = JSON.parse(datas.value);
            document.getElementById('edit_id').value = datas['0'];
            document.getElementById('edit_code').value = datas['1'];
            document.getElementById('edit_services_name').value = datas['2'];
        }
    </script>
@endsection
