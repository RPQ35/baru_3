<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        /* Optional: Add a style to hide overflow for the running text container */
        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
        }

        #marquee-text {
            display: inline-block;
            /* Ensure it is an inline-block for transform to work correctly */
        }
    </style>
</head>


@php
    $countes = count(array_filter($que, fn($item) => $item['status'] === true));
    $backup_count = $countes;
    $row_count = count($que);
    $delay=8000;
    $cols=1;
    $loketNumber = '2';

    // Loket number (can be dynamic later)
    $sdelay = $delay * 2 + 1000;

    // Common audio library
    $library = [
        'start' => asset('audio/start.mp3'),
        'nomor' => asset('audio/nomor.mp3'),
        'antrian' => asset('audio/antrian.mp3'),
        'silahkan' => asset('audio/silahkan.mp3'),
        'menuju' => asset('audio/menuju.mp3'),
        'loket' => asset('audio/loket.mp3'),
        'loket_no' => asset("audio/angka/{$loketNumber}.mp3"),
        'end'=>asset('audio/end.mp3'),
    ];

    foreach (range('A', 'Z') as $letter) {
        $library[strtolower($letter)] = asset("audio/huruf/{$letter}.mp3");
    }

    foreach (range(0, 9) as $num) {
        $library[(string) $num] = asset("audio/angka/{$num}.mp3");
    }

@endphp
<script>
    localStorage.setItem('refresh', @json($countes));
    localStorage.setItem('refresh_count', @json($countes));
</script>

@yield('to_session')


<body class="bg-primary sb-nav-fixed">
    <div id="layoutAuthentication">
        <main>
            <div class="container-fluid" style="height: 100vh">
                <div class="row" style="height: 100vh;">
                    <div class="col-lg-4">
                        <div class="card shadow-lg border-0 rounded-lg mt-5" style="height: 90vh">
                            <div class="card-body col" style="padding-top: 40px">
                                @foreach ($que as $item)
                                    {{-- card if the data is active | true called --}}
                                    @if ($item['status'])
                                        <x-card bgcolor="bg-warning" href="" title="Locket" size="12"
                                            footer="false" text="text-black">
                                            <big>{{ $item['data'] }}</big>
                                        </x-card>

                                        @include('signage.activeaudio')
                                        {{-- ==================================== --}}


                                        {{-- normal card | not active  --}}
                                    @else
                                        <x-card bgcolor="bg-secondary" href="" title="Locket" size="12"
                                            footer="false" text="text-black">
                                            <big>{{ $item['data'] }}</big>
                                        </x-card>
                                    @endif
                                    {{-- ============ --}}

                                    {{-- tab refresher --}}
                                    @php $countes -= 1; @endphp
                                    @if ($loop->iteration >= $row_count)
                                        <script>
                                            const refreshDelay = localStorage.getItem('refresh') === '0' ? 8000 : @json($delay) +
                                                @json($sdelay) -1500;

                                            setTimeout(() => {
                                                location.reload();
                                            }, refreshDelay);
                                        </script>
                                    @endif
                                    {{-- =========== --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class=" mt-5" style="height: 90vh">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5" style="height: 90vh;">
                            <div class="card-body">
                                <video src="{{ $video }}" style="max-width: 100%; max-height: 90%;"
                                    id="myVideo" autoplay></video>
                                <div class="col-xl-12 col-md-2">
                                    <div class="card bg-white text-black mb-4">
                                        <div class="card-body marquee-container">
                                            <big id="marquee-text"
                                                style="text-transform: capitalize; font-weight: bolder;">{{ $text }}</big>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/signage.js') }}"></script>
</body>

</html>
