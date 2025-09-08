{{-- ____________________________ code (js and php) for count row & audio library ____________________________________ --}}
@php
    // locket number (can be change)
    $loketNumber = '2';

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

{{-- _________________________________________________________________________________________________________________ --}}
{{-- ____________________________ main display card __________________________________________________________________ --}}

<div wire:poll.{{ $pollInterval }} class="col-lg-7" >
    <div class="card shadow-lg border-0 rounded-lg mt-5" style="height: 90vh">
        <div class="card-body row grid justify-content-center align-middle" style="padding-top: 40px; gap: 5rem;">
            @forelse ($que as $item)
                @if ($item['status'])
                    {{-- =========== card if the data is active | is_called ========= --}}

                    {{-- --- queue display card ----------- --}}
                    <x-card href="" title="Locket" size="5" text="text-black fs-1 fw-semibold font "
                        bgcolor="bg-warning h-80" footer="false"
                        body_class="d-flex flex-column justify-content-center text-center">

                        <big>
                            {{ $item['data'] }}
                        </big>


                    </x-card>

                    {{-- --- audio player | voice player --- --}}
                    @include('signage.activeaudio')

                    {{-- ============================================================== --}}
                @else
                    {{-- =========== normal card | not active  ======================== --}}

                    <x-card href="" title="Locket" size="5" text="text-black fs-1 fw-semibold font  "
                        bgcolor="bg-primary h-80" footer="false"
                        body_class="d-flex flex-column justify-content-center text-center">

                        <div class="row d-flex justify-content-center">
                            <big class="">
                                {{ $item['data'] }}
                            </big>

                        </div>

                    </x-card>

                    {{-- ============================================================== --}}
                @endif
                @php
                    $delay *= 1.64;
                    $countes -= 1;
                @endphp
            @empty
            @endforelse
        </div>
    </div>

</div>
