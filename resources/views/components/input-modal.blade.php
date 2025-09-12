@props(['action' => '#'])

<div class="modal fade" id="inputModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" action="{{ $action }}">
        @csrf
        <div class="modal-header position-relative">
          <h5 class="modal-title position-absolute top-50 start-50 translate-middle" id="modalTitle"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <input type="hidden" name="services_id" id="serviceId">
          <div id="serviceLogo" class="mb-3"></div>
          <div class="mb-3">
            <label id="inputLabel" class="form-label"></label>
            <input type="text" name="vehicle_number" id="vehicleInput" class="form-control" required>
          </div>

          <!-- Tempat keyboard -->
          <div id="keyboard" class="vh-40vw-100 d-flex flex-column"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Ambil Nomor</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
