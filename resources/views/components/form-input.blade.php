@props([
    'title' => 'input',
    'name' => 'name',
    'type' => 'text',
])

<div class="col-md-12">
    <label for="{{ $name }}" class="form-label">{{ $title }}</label>
    <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}"
        value="{{ old($name) }}">
</div>
