@props(['message' => null])

@if($message)
<div class="modal fade show" id="successModal" tabindex="-1" style="display:block; background:rgba(0,0,0,.5)">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Berhasil!</h5>
      </div>
      <div class="modal-body">
        <h4>{{ $message }}</h4>
        <p class="text-muted">Halaman akan refresh otomatis dalam <span id="countdown">5</span> detik...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="closeSuccess()">OK</button>
      </div>
    </div>
  </div>
</div>
@endif
