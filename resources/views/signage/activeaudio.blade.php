@php
$queueCode = strtolower($item['data']);
$audioSequence = array_merge(
    [$library['start'], $library['nomor'], $library['antrian']],
    array_map(fn($char) => $library[$char] ?? null, str_split($queueCode)),
    [
        $library['silahkan'],
        $library['menuju'],
        $library['loket'],
        $library['loket_no'],
    ],

);
$audioSequence = array_filter($audioSequence);

// $delayold = $delayval;
$delay *= 1.64;

@endphp

<script>
document.addEventListener("DOMContentLoaded", () => {
    const files = @json($audioSequence);
    let index = 0;

    function playNext() {
        if (index < files.length) {
            const audio = new Audio(files[index]);
            index++;
            audio.addEventListener("ended", playNext);
            audio.play();
        }
    }

    const bcou = @json($backup_count);
    const cou = @json($countes);

    if (bcou === cou) {
        playNext();
        setTimeout(() => {
            localStorage.setItem('refresh_count', parseInt(localStorage.getItem('refresh_count')) -
                1);
        }, @json($delay));
    } else if (@json($loop->iteration) == @json($backup_count)) {
        setTimeout(playNext, @json($delay));
        setTimeout(() => {
            localStorage.setItem('refresh_count', parseInt(localStorage.getItem('refresh_count')) -
                1);
        }, @json($delay) - 1000);
    } else if (@json($countes) >= 0) {
        setTimeout(playNext, @json($delay));
        setTimeout(() => {
            localStorage.setItem('refresh_count', parseInt(localStorage.getItem('refresh_count')) -
                1);
        }, @json($delay));
    }
});
</script>