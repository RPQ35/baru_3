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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="style.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .font {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v48/KFO7CnqEu92Fr1ME7kSn66aGLdTylUAMa3iUBGEe.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

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
    $delay = 8000;
    $cols = 1;
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
        'end' => asset('audio/end.mp3'),
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
                                            footer="false" text="text-black fs-3 fw-semibold font">
                                            <big>{{ $item['data'] }}</big>
                                        </x-card>

                                        @include('signage.activeaudio')
                                        {{-- ==================================== --}}


                                        {{-- normal card | not active  --}}
                                    @else
                                        <x-card bgcolor="bg-secondary" href="" title="Locket" size="12"
                                            footer="false" text="text-black fs-3 fw-semibold font">
                                            <big>{{ $item['data'] }}</big>
                                        </x-card>
                                    @endif
                                    {{-- ============ --}}

                                    {{-- tab refresher --}}
                                    @php $countes -= 1; @endphp
                                    @if ($loop->iteration >= $row_count)
                                        <script>
                                            const refreshDelay = localStorage.getItem('refresh') === '0' ? 8000 : @json($delay) +
                                                @json($sdelay) - 1500;

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
