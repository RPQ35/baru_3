@extends('layouts.body')
@section('title', 'Daftar Akun')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Account" breadcrumb="account/data" href="{{ route('create.account') }}"
                button="Create Account" />

            {{-- _____________ data table _________________________ --}}
            <x-table title="List Account">
                <x-slot name="thead">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </x-slot>


                <x-slot name="tbody">
                    @foreach ($data as $key => $acc)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $acc->name }}</td>
                            <td>{{ $acc->email }}</td>
                            <td>{{ $acc->roles->pluck('name')->join(', ') }}</td>
                            <td>
                                <form action="{{ route('account.destroy', $acc->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus akun ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn-group">
                                        <button type="button" funct="OpenModal" class="btn btn-secondary btn-sm"
                                            value='["{{ $acc->id }}","{{ $acc->name }}","{{ $acc->email }}","{{ $acc->roles->pluck('name')->join(', ') }}"]'
                                            onclick="editmodal(this)">Edit</button>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            {{-- __________________________________________________ --}}
            {{-- _____________ modal edit _________________________ --}}
            <x-NewModal title="Edit Account">
                <form action="{{ route('account.update') }}" method="post">
                    @csrf
                    <input name="id" value="" id="ids" type="hidden">
                    {{-- Nama --}}
                    <x-form-input title="Nama" name="name" type="text" />

                    {{-- Email --}}
                    <x-form-input title="email" name="email" type="email" />

                {{-- Role --}}
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select" required>
                        @foreach (\Spatie\Permission\Models\Role::all() as $role)
                        {{-- digunakan untuk mengelola role & permission --}}
                            <option value="{{ $role->name }}" class="role-opt">
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                    {{-- Password (opsional) --}}
                    <x-form-input title="password" name="password" type="text" />
                    <small>kosongkan jika tidak ingin mengganti</small>

                    <x-slot name="footer">
                        <x-modal-foot-button></x-modal-foot-button>
                    </form>
                    </x-slot>
            </x-NewModal>

            {{-- modal script --}}
            <script>
                function editmodal(datas) {
                    datas = JSON.parse(datas.value);

                    document.getElementById("ids").value = datas[0];
                    document.getElementById("name").value = datas[1];
                    document.getElementById("email").value = datas[2];

                    var opt = document.querySelectorAll(".role-opt");

                    opt.forEach(Opti => {
                        const matchingOpt = document.querySelector(`.role-opt[value="` + datas[3] + `"]`);
                        if (matchingOpt) {
                            matchingOpt.selected = true;
                        }
                    });
                }
            </script>

        </div>
    </main>
@endsection
