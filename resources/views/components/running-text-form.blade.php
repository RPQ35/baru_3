@props(['data'])

<!-- Tombol buka modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#runningTextModal">
    Edit Running Text
</button>

<!-- Modal -->
<div class="modal fade" id="runningTextModal" tabindex="-1" aria-labelledby="runningTextModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('running_text.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="runningTextModalLabel">Edit Running Text</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="runningText" class="form-label">Running Text</label>
                        <textarea name="text" id="runningText" class="form-control" rows="3" required>{{ $data }}</textarea>
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
