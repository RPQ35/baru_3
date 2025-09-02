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
