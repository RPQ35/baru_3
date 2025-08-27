@extends('layouts.body')
@section('title', 'admin locket')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Locket" breadcrumb="locket/data" href="/admin/locket/create"
                button="create locket"></x-breadcrumb>

            {{-- data table --}}
            <x-table>

                <x-slot name="thead">
                    <tr>
                        <th>Nama</th>
                        <th>Layanan</th>
                        <th>Action</th>
                    </tr>
                </x-slot>

                {{-- @dd($data) --}}
                <x-slot name="tbody">
                    @if (isset($data))
                        @foreach ($data as $item)
                            <tr>
                                <td><big>{{ $item['name'] }}</big></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        @foreach ($item['service'] as $val)
                                            @php
                                                $loop->iteration == 1
                                                    ? ($color = 'btn-secondary')
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
                                <td>
                                    @php
                                        $ids = $item['id'];
                                    @endphp
                                    {{-- @dd($ids) --}}
                                    <form action="{{ route('admin.destroy.locket', $ids) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            <button type="button" funct="editmodal" class="btn btn-secondary btn-sm"
                                                onclick="editmodal(this.value)" value="{{ $loop->index }}">Edit</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </x-slot>
            </x-table>
            {{-- =========== --}}

            <x-modal_update title="Edit Locket" action="{{ route('admin.locket.update') }}">
                <div class="col-md-12">
                    <label for="inp" class="form-label">Edit Name</label>
                    <input type="text" class="form-control" id="inp" name="name" value="">
                </div>
                <input type="text" name="id" id="ids" class="invisible">

                <br>
                {{--  --}}
                @foreach ($services_list as $item)
                    @if ($loop->iteration % 3 == 1)
                        <div class="btn-group col-md-12" role="group" aria-label="Basic checkbox toggle button group">
                    @endif

                    <input type="checkbox" class="btn-check checkbx" id="{{ $item->services_name }}" name="services[]"
                        autocomplete="off" value="{{ $item->id }}">
                    <label class="btn btn-outline-primary"
                        for="{{ $item->services_name }}">{{ $item->services_name }}</label>
                    @if ($loop->iteration % 3 == 0 || $loop->last)
        </div>
        @endif
        @endforeach
        </x-modal_update>



        <script>
            var data_arr = @json($data);
            window.editmodal = function(val) {

                var myModal = document.getElementById('myModal');
                var edit_data = data_arr[val];

                document.getElementById('inp').value = edit_data.name;
                document.getElementById('ids').value = edit_data.id;

                const serviceCheckboxes = document.querySelectorAll('.checkbx');

                serviceCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });

                edit_data.service.forEach(service => {
                    const matchingCheckbox = document.querySelector(`.checkbx[value="` + service.id + `"]`);
                    if (matchingCheckbox) {
                        matchingCheckbox.checked = true;
                    }
                });

            };
        </script>


        </div>
    </main>
@endsection
