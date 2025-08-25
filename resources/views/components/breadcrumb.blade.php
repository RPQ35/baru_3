@props([
    'title' => 'dashboard',
    'href' => '/',
    'breadcrumb' => 'dashboard',
    'button' => 'button',
    'onclick' => "window.location.href=' $href ';",
])
<h1 class="mt-4">{{ $title }}</h1>
<ol class="breadcrumb mb-4 d-flex justify-content-between">
    <li class="breadcrumb-item active  ">{{ $breadcrumb }}</li>
    <button type="button" class="btn btn-primary " onclick="{{ $onclick }}">{{ $button }}</button>

</ol>
