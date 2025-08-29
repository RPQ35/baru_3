@extends('layouts.body')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            <x-form method="POST" action="{{ route('admin.locket.store') }}">

                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option selected hidden>Open this select menu</option>
                        @forelse ($data as $item)
                            <option value="{{ $item['name'] }}">
                                {{ $item['name'] }}
                                {
                                @foreach ($item['service'] as $option)
                                   | {{ $option['services_name'] }}
                                @endforeach
                                }
                            </option>
                        @empty
                        @endforelse
                    </select>
                    <label for="floatingSelect">Works with selects</label>
                </div>

            </x-form>
        </div>
    </main>
@endsection
