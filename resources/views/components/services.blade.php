<div>
    {{-- Form Tambah Service --}}
    <form action="{{ route('services.store') }}" method="POST" class="mb-4">
        @csrf
        <div>
            <label for="name">Nama Service</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <button type="submit">Tambah Service</button>
    </form>

    {{-- Table Service --}}
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
