<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>@yield('kiosk')</title>
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
            /* max-width: 60px; */
            /* max-height: 60px; */
            width: 8rem;
            height: 3.5rem;
            object-fit: contain;
            border-radius: 8px;
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

    <x-input-modal :action="route('kiosk.takeNumber')" />
    <x-success-modal :message="session('success')" />
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
