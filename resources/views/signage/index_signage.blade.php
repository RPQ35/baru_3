@extends('signage.signage-body')

{{-- _________________________________________________________________________________________________________________ --}}
{{-- ____________________________ code (js and php) for count row & audio library ____________________________________ --}}
@section('code')
    @php
        // locket number (can be change)
        $loketNumber = '2';

        // count row ( true data and overall data )
        $countes = count(array_filter($que, fn($item) => $item['status'] === true));
        $backup_count = $countes;
        $row_count = count($que);

        // delay time between card call
        $delay = 8000;

        // bonus delay for refresh after audio play
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
        // importing letter audio
        foreach (range('A', 'Z') as $letter) {
            $library[strtolower($letter)] = asset("audio/huruf/{$letter}.mp3");
        }
        // importing number audio
        foreach (range(0, 9) as $num) {
            $library[(string) $num] = asset("audio/angka/{$num}.mp3");
        }

    @endphp
    <script>
        // transfer data row count into js var
        localStorage.setItem('refresh', @json($countes));
        localStorage.setItem('refresh_count', @json($countes));
    </script>
@endsection
{{-- _________________________________________________________________________________________________________________ --}}
{{-- ____________________________ left side | queue display & audio player ___________________________________________ --}}
@section('que-card')
    <div class="col-lg-4">
        <div class="card shadow-lg border-0 rounded-lg mt-5" style="height: 90vh">
            <div class="card-body col" style="padding-top: 40px">
                @foreach ($que as $item)
                    @if ($item['status'])
                        {{-- =========== card if the data is active | is_called ========= --}}

                        {{-- --- queue display card ----------- --}}
                        <x-card href="" title="Locket" size="12" text="text-black fs-3 fw-semibold font"
                            bgcolor="bg-warning" footer="false">

                            <big>
                                {{ $item['data'] }}
                            </big>

                        </x-card>

                        {{-- --- audio player | voice player --- --}}
                        @include('signage.activeaudio')

                        {{-- ============================================================== --}}
                    @else
                        {{-- =========== normal card | not active  ======================== --}}

                        <x-card href="" title="Locket" size="12" text="text-black fs-3 fw-semibold font"
                            bgcolor="bg-secondary" footer="false">

                            <big>
                                {{ $item['data'] }}
                            </big>

                        </x-card>

                        {{-- ============================================================== --}}
                    @endif

                    {{-- =========== window tab refresher ============================= --}}
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
                    {{-- ============================================================== --}}
                @endforeach
            </div>
        </div>
    </div>
@endsection
{{-- _________________________________________________________________________________________________________________ --}}
{{-- ____________________________ Right side |entertaiment display (video & running text) __________________________ --}}
@section('entertaiment')
    <div class="col-lg-7">
        <div class="card shadow-lg border-0 rounded-lg mt-5" style="height: 90vh;">
            <div class="card-body">
                {{-- =========== video display =================================== --}}
                <video style="max-width: 100%; max-height: 90%;" id="myVideo"
                        src="{{ $video }}" autoplay>
                    </video>
                {{-- ============================================================== --}}
                {{-- =========== running text display ============================= --}}
                <div class="col-xl-12 col-md-2">
                    <div class="card bg-white text-black mb-4">

                        <div class="card-body marquee-container">
                            <big id="marquee-text"
                                style="text-transform: capitalize; font-weight: bolder;">
                                    {{ $text }} 
                            </big>
                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between">
                        </div>
                    </div>
                </div>
                {{-- ============================================================== --}}
            </div>
        </div>
    </div>
@endsection
{{-- _________________________________________________________________________________________________________________ --}}
