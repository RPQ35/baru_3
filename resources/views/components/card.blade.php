@props([
    'bgcolor' => 'bg-primary',
    'title' => 'Card',
    'href' => '#',
    'footer' => 'true',
    'size' => 3,
    'text' => 'text-white',
    'style' => '',
    'body_class' => '
    ',
])

<div class="col-xl-{{ $size }} col-md-6">
    <div class="card {{ $bgcolor }} {{ $text }} mb-4 ">
        <div class="card-body {{ $body_class }}">
            {{ $title }}
            <br>
            {{ $slot }}
        </div>

        <div class="card-footer d-flex align-items-center justify-content-between">
            @if (($footer == 'true') && !isset($foot))
                <a class="small {{ $text }} stretched-link" href="{{ $href }}">View Details</a>
                <div class="small {{ $text }}"><i class="fas fa-angle-right"></i></div>
            @elseif(isset($foot))
                {{ $foot }}
            @else
            @endif
        </div>
    </div>
</div>
