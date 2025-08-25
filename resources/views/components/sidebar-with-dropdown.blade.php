@props([
    'title' => 'title',
])

@php
    use Illuminate\Support\Str;

    $random = Str::random(8);
    // dd($random);
@endphp

<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#{{ $random }}"
    aria-expanded="false" aria-controls="{{ $random }}">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    {{ $title }}
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="{{ $random }}" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        {{ $slot }}
    </nav>
</div>
