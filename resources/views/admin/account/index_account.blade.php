@extends('layouts.body')
@section('title', 'Daftar Akun')
@section('main')
<main>
    <div class="container-fluid px-4">
        <x-breadcrumb title="Account"
                      breadcrumb="account/data"
                      href="{{ route('create.account') }}"
                      button="Create Account" />

        {{-- Data Table --}}
        <x-table title="Daftar Akun">
            <x-slot name="thead">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </x-slot>

            <x-slot name="tbody">
                @foreach ($data as $key => $acc)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $acc->name }}</td>
                        <td>{{ $acc->email }}</td>
                        <td>{{ $acc->roles->pluck('name')->join(', ') }}</td>
                        <td>
                            <form action="{{ route('account.destroy', $acc->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus akun ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </div>
</main>
@endsection
