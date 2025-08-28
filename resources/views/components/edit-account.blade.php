@props(['acc', 'roles'])

<!-- Tombol trigger -->
<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $acc->id }}">
    Edit
</button>

<!-- Modal -->
<div class="modal fade" id="editModal{{ $acc->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $acc->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $acc->id }}">Edit Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('account.update', $acc->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name{{ $acc->id }}" class="form-label">Nama</label>
                        <input type="text" id="name{{ $acc->id }}" name="name"
                               class="form-control" value="{{ old('name', $acc->name) }}" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email{{ $acc->id }}" class="form-label">Email</label>
                        <input type="email" id="email{{ $acc->id }}" name="email"
                               class="form-control" value="{{ old('email', $acc->email) }}" required>
                    </div>

                    {{-- Role --}}
                    <div class="mb-3">
                        <label for="role{{ $acc->id }}" class="form-label">Role</label>
                        <select id="role{{ $acc->id }}" name="role" class="form-select" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ $acc->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Password (opsional) --}}
                    <div class="mb-3">
                        <label for="password{{ $acc->id }}" class="form-label">Password (opsional)</label>
                        <input type="password" id="password{{ $acc->id }}" name="password" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti</small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
