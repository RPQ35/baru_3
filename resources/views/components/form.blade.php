@props([
    'action' => '',
    'method' => '',
    'enctype' => '',
])



<div class="card mb-4 ">
    <div class="card-body">
        <form class="row g-3" method="{{ $method }}" action="{{ $action }}" enctype="{{ $enctype }}">
            @csrf
            {{ $slot }}
            <div class="col-6">
                <button type="submit" class="btn btn-primary" id="subm">Add</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>

        </form>
    </div>
</div>
