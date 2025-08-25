@props([
    'route' => '',
    'method' => '',
    'enctype' => '',
])



<div class="card mb-4 ">
    <div class="card-body">
        <form class="row g-3" method="{{ $method }}" action="{{ $route }}" enctype="{{ $enctype }}">
            @csrf
            {{ $slot }}
            <div class="col-6">
                <button type="submit" class="btn btn-primary">add</button>
                <button type="reset" class="btn btn-danger">cancel</button>
            </div>

        </form>
    </div>
</div>
