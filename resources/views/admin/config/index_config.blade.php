@extends('layouts.body')
@section('title', 'running text')
@section('head')
    <style>
        <style>@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            @apply bg-gray-100 flex items-center justify-center min-h-screen p-4;
        }

        /* The switch container */
        .switch {
            position: relative;
            display: inline-block;
            width: 80px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider knob */
        .slider {
            border-radius: 10px;
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
            @apply rounded-full;
        }

        /* The circular knob */
        .slider:before {
            position: absolute;
            border-radius: 14px;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            @apply rounded-full;
        }

        /* Change background color when checked */
        input:checked+.slider {

            background-color: #2563eb;
        }

        /* Move the knob when checked */
        input:checked+.slider:before {
            -webkit-transform: translateX(46px);
            -ms-transform: translateX(46px);
            transform: translateX(46px);
        }
    </style>
    </style>
@endsection
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Config" breadcrumb="configutration" href="" button="false" />


            @forelse ($config as $item)
                <div class="d-flex flex-row w-full justify-content-between align-items-center">
                    <div class="d-flex flex-row w-full">
                        <div class="d-flex flex-column">
                            <div class="">
                                <label class="switch">
                                    <input type="checkbox" id="mySwitch" {{ $item->swicth ? 'checked' : '' }}
                                        data-values="{{ $item->option }}" onchange="swicth(this)">
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <p class="{{ $item->swicth ? 'text-success' : '' }}" id="statusMessage">
                                {{ $item->swicth ? 'Status: On' : 'Status: Off' }}</p>
                        </div>
                        <p class="fs-5 mx-2">structural locket</p>
                    </div>
                    <button class="btn btn-sm btn-secondary rounded-5" funct="OpenModal">?</button>
                </div>
            @empty
            @endforelse

            <x-NewModal potition="center" title="? information">
                jika structural locket diaktifkan ;<br />
                maka loket akan memiliki struktur atau level atau tingkatan,
                dan antrian yang berjalan akan di tampilkan ke locket sesuai dengan status nya saat ini
                <br>
                <div class="btn-group">
                    <button class="btn btn-primary btn-sm " disabled>new</button>
                    <button class="btn btn-success btn-sm " disabled>proggres</button>
                    <button class="btn btn-warning btn-sm " disabled>stage</button>
                    <button class="btn btn-danger btn-sm " disabled>end</button>
                </div>
            </x-NewModal>
        </div>
    </main>
    <script>
        function swicth(target) {
            // Get the switch and status message elements
            const mySwitch = target;
            const TargetVal = target.getAttribute('data-values');
            const statusMessage = document.getElementById('statusMessage');
            var swicther = false;

            // Add an event listener to the switch to detect changes

            if (mySwitch.checked) {
                statusMessage.textContent = 'Status: On';
                statusMessage.classList.remove('text-black');
                statusMessage.classList.add('text-success');
                swicther = true;

            } else {
                statusMessage.textContent = 'Status: Off';
                statusMessage.classList.remove('text-success');
                statusMessage.classList.add('text-black');
                swicther = false;
            }



            const formData = new FormData();
            formData.append('option', TargetVal);
            formData.append('swicth', swicther);


            fetch('/admin/config/swicth', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    // Check if the server response was successful
                    if (!response.ok) {
                        // If not, throw an error with the status text
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    // If it was successful, parse the JSON
                    return response.json();
                })
                .then(data => {
                    // This block only runs if the update was successful
                    console.log(data);
                })
                .catch(error => {
                    // This block now correctly catches both network errors and server-side errors
                    console.error('Error:', error);
                });

        }
    </script>

@endsection
