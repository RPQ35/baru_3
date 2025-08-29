@props([
    'action' => '#',
    'title' => 'edit modal',
])

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Use the document body or a specific parent container
        document.body.addEventListener('click', function(event) {
            const clickedButton = event.target.closest('.btn[funct="editmodal"]');
            if (clickedButton) {
                var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                myModal.show();
            }
        });
    });
</script>
