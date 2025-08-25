@props([
    'data',
    'route' => '',
    'title' => 'Edit Running Text',
    'enctype' => '',
    'file' => 'false',
    'name' => 'text',
])

<!-- Tombol buka modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
    {{ $title }}
</button>

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ $route }}" enctype="{{ $enctype }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modalinp" class="form-label">{{ ltrim($title, 'Edit') }}</label>
                        @if ($file == 'true')
                            <input type="file" name="{{ $name }}">
                        @else
                            <textarea name="{{ $name }}" id="modalinp" class="form-control" rows="3" required>{{ $data }}</textarea>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
