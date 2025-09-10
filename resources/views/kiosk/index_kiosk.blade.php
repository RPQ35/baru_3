<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>@yield('kiosk')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/kiosk.css') }}">
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

    <x-input-modal :action="route('kiosk.takeNumber')" />
    <x-success-modal :message="session('success')" />
      <script src="{{asset('js/keyboard.js')}}"></script>
      <script>
    // Tutup success modal
    function closeSuccess() {
        const modal = document.getElementById('successModal');
        modal.style.display = "none";
        location.reload(); // langsung refresh kalau klik OK
    }

    // Kalau ada success modal, set auto refresh
    const successModal = document.getElementById('successModal');
    if (successModal) {
        let counter = 5; // detik
        const countdown = document.getElementById('countdown');
        const interval = setInterval(() => {
            counter--;
            countdown.textContent = counter;
            if (counter <= 0) {
                clearInterval(interval);
                location.reload(); // refresh halaman
            }
        }, 1000);
    }
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('#inputModal form');
    const input = document.getElementById('vehicleInput');

    form.addEventListener('submit', function(e) {
        const value = input.value.trim();

        // Cek kosong
        if (!value) {
            e.preventDefault();
            alert("Nomor kendaraan wajib diisi!");
            return;
        }

        // Cek tag HTML/script
        if (/[<script>]/.test(value)) {
        e.preventDefault();
        alert("Nomor kendaraan tidak boleh tag html maupun script");
        return;
    }


        // Cek link / URL
        if (/https?:\/\//i.test(value)) {
            e.preventDefault();
            alert("Nomor kendaraan tidak boleh berupa link/URL!");
            return;
             }
    });
});
</script>
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
        </script>
    <script src="{{asset('js/keyboard.js')}}"></script>
    <script src="{{ asset('js/scriptkios.js') }}"></script>



</body>
</html>
