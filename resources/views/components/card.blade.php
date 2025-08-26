@props([
    'bgcolor'=>'bg-primary',
    'title'=>'Card',
    'href'=>'#',
    'footer'=>'true',
    'size'=>3,
])

<div class="col-xl-{{ $size }} col-md-6">
    <div class="card {{ $bgcolor }} text-white mb-4">
        <div class="card-body">
            {{ $title }}
            <br>
            {{ $slot }}
        </div>

        <div class="card-footer d-flex align-items-center justify-content-between">
           @if ($footer!="false")
           <a class="small text-white stretched-link" href="{{ $href }}">View Details</a>
           <div class="small text-white"><i class="fas fa-angle-right"></i></div>
           @endif
        </div>
    </div>
</div>