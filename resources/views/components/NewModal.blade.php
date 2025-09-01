<div class="modal fade" id="MyModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog {{ $potition }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                   @if (isset($footer))
                    {{ $footer }}
                   @endif
                </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Use the document body or a specific parent container
        document.body.addEventListener('click', function(event) {
            const clickedButton = event.target.closest('.btn[funct="OpenModal"]');
            if (clickedButton) {
                var myModal = new bootstrap.Modal(document.getElementById("MyModal"));
                myModal.show();
            }
        });
    });
</script>
