@extends('layouts.body')
@section('title', 'admin locket')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb   title="Locket"
                            breadcrumb="locket/data"
                            href="/admin/locket/create"
                            button="create locket"></x-breadcrumb>

            {{-- data table --}}
            <x-table>

                <x-slot name="thead">
                    <tr>
                        <th>nama</th>
                        <th>layanan</th>
                    </tr>
                </x-slot>


                <x-slot name="tbody">
                    @if (isset($data))
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        @foreach ($item['service'] as $val)
                                            @php
                                                $loop->iteration == 1
                                                    ? ($color = 'btn-danger')
                                                    : ($loop->iteration == 2
                                                        ? ($color = 'btn-success')
                                                        : ($loop->iteration == 3
                                                            ? ($color = 'btn-warning')
                                                            : ($loop->iteration == 4
                                                                ? ($color = 'btn-info')
                                                                : ($loop->iteration == 5
                                                                    ? ($color = 'btn-primary')
                                                                    : ''))));
                                            @endphp
                                            <button type="button"
                                                class="btn {{ $color }}">{{ $val['services_name'] }}</button>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </x-slot>
            </x-table>
            {{-- =========== --}}



           
        </div>
    </main>
@endsection
