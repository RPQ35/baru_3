@if (session('locket')!==null)
<script>
    window.location.href = "/lockets/app";
</script>
@else

@endif

@extends('layouts.body')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Locket" breadcrumb="locket/select" href=""
                button="false"></x-breadcrumb>

            <x-form method="post" action="{{ route('lockets.main') }}">
                @csrf
                <div class="form-floating">
                    <select name="select" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option selected hidden>Lockets type</option>
                        @forelse ($data as $item)
                            <option value="{{ $item['id'] }}">

                                {{ $item['name'] }}
                                =>
                                @foreach ($item['service'] as $option)
                                    @if ($loop->iteration > 1)
                                    |
                                    @endif
                                    {{ $option['services_name'] }}
                                @endforeach

                            </option>
                        @empty
                        @endforelse
                    </select>
                    <label for="floatingSelect">Select Lockets</label>
                </div>

            </x-form>
        </div>
    </main>
@endsection
