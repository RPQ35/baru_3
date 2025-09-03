<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(#0096FF 0%, #89CFF0 25%, #F0FFFF 150%);
        }
        .oval-button {
            padding: 20px 40px;
            background-color: #2d3e50;
            color: white;
            font-weight: bold;
            border-radius: 50px;
            border: 2px solid #999;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.4);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-width: 220px;
            min-height: 110px;
            font-size: 18px;
            transition: 0.2s;
        }
        .oval-button:hover {
            background-color: #1c2833;
            transform: scale(1.05);
        }
        .oval-button img {
            max-width: 60px;
            max-height: 60px;
            object-fit: contain;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h2 class="mb-5 text-white">Pilih Layanan</h2>

    <div class="container">
        <div class="row w-100 justify-content-center">
            @foreach($servi as $service)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex justify-content-center">
                    <button type="button"
                        class="oval-button"
                        data-bs-toggle="modal"
                        data-bs-target="#inputModal"
                        data-id="{{ $service->id }}"
                        data-name="{{ $service->services_name }}"
                        data-label="{{ $service->input_label }}"
                        data-logo="{{ asset('storage/' . $service->logo_path) }}">
                        @if($service->logo_path)
                            <img src="{{ asset('storage/' . $service->logo_path) }}" alt="logo">
                        @endif
                        {{ $service->services_name }}
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Modal Input --}}
    <div class="modal fade" id="inputModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form method="POST" action="{{ route('kiosk.takeNumber') }}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitle"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <input type="hidden" name="services_id" id="serviceId">
                <div id="serviceLogo" class="mb-3"></div>
                <div class="mb-3">
                    <label id="inputLabel" class="form-label"></label>
                    <input type="text" name="vehicle_number" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Ambil Nomor</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Modal Success --}}
    @if(session('success'))
    <div class="modal fade show" id="successModal" tabindex="-1" style="display:block; background:rgba(0,0,0,.5)">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title">Berhasil!</h5>
          </div>
          <div class="modal-body">
            <h4>{{ session('success') }}</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="closeSuccess()">OK</button>
          </div>
        </div>
      </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Modal input isi otomatis
        const inputModal = document.getElementById('inputModal');
        inputModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const serviceId = button.getAttribute('data-id');
            const serviceName = button.getAttribute('data-name');
            const serviceLabel = button.getAttribute('data-label');
            const serviceLogo = button.getAttribute('data-logo');

            inputModal.querySelector('#modalTitle').textContent = serviceName;
            inputModal.querySelector('#serviceId').value = serviceId;
            inputModal.querySelector('#inputLabel').textContent = serviceLabel;
            inputModal.querySelector('#serviceLogo').innerHTML = `<img src="${serviceLogo}" alt="logo" style="max-height:80px">`;
        });

        // Tutup success modal
        function closeSuccess() {
            const modal = document.getElementById('successModal');
            modal.style.display = "none";
        }
    </script>

</body>
</html>
