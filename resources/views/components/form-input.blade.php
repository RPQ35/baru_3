@props([
    'title' => 'input',
    'name' => 'name',
])

<div class="col-md-12">
    <label for="inputEmail4" class="form-label">{{ $title }}</label>
    <input type="email" class="form-control" id="inputEmail4" name="{{ $name }}">
</div>
