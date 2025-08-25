@props([
    'title' => 'item',
    'href' => '',
    'icon'=>'fas fa-tachometer-alt'
])
<a class="nav-link" href="/{{ $href }}">
    <div class="sb-nav-link-icon">
        @if (Request::is($href ) || Request::is($href. '/create'))
            <i class="{{ $icon }}" style=" color: cornflowerblue;"></i>
        @else
            <i class="{{ $icon }}"></i>
        @endif
    </div>
    {{ $title }}
</a>
