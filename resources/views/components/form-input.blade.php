@props([
    'title' => 'input',
    'name' => 'name',
    'type' => 'text',
    'div_Id'=>''
])

<div class="col-md-12" id="{{ $div_Id }}">
    <label for="{{ $name }}" class="form-label">{{ $title }}</label>
    <input type="{{ $type }}" {{ $attributes }}  class="form-control" id="{{ $name }}" name="{{ $name }}"
        value="{{ old($name) }}" autofocus>
    {{ $slot }}
</div>
