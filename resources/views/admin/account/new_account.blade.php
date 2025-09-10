@extends('layouts.body')
@section('title', 'Create Account')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Create Account" breadcrumb="account/create" href="{{ route('index.account') }}"
                button="Back" />


            <x-form action="{{ route('account.store') }}" method="POST" enctype="">


                {{-- Nama --}}
                <x-form-input name="name" title="Nama">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </x-form-input>

                {{-- Email --}}
                <x-form-input name="email" title="Email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </x-form-input>

                {{-- Password --}}
                <div class="mb-3">
                    <x-form-input name="password" title="Password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </x-form-input>
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih role</option>
                        @foreach (\Spatie\Permission\Models\Role::all() as $role)
                         {{-- used to manage roles & permissions --}}
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


            </x-form>
        </div>

    </main>
@endsection
