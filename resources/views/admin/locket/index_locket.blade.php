@extends('layouts.body')
@section('title', 'admin locket')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Locket" breadcrumb="locket/data" href="/admin/locket/create"
                button="create locket"></x-breadcrumb>

            {{-- _____________ data table _________________________ --}}
            <x-table>

                <x-slot name="thead">
                    <tr>
                        <th>Nama</th>
                        <th>Layanan</th>
                        <th>Action</th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($data as $item)
                        <tr>
                            <td>
                                <big>{{ $item['name'] }}</big>
                            </td>
                            <td>
                                {{-- display service that locket have --}}
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    @foreach ($item['service'] as $val)
                                        {{-- ignore | service display color  --}}
                                        @php
                                            $loop->iteration % 5 == 0
                                                ? ($color = 'btn-success    ')
                                                : ($loop->iteration % 4 == 0
                                                    ? ($color = 'btn-info')
                                                    : ($loop->iteration % 3 == 0
                                                        ? ($color = 'btn-warning')
                                                        : ($loop->iteration % 2 == 0
                                                            ? ($color = 'btn-secondary')
                                                            : ($loop->iteration % 1 == 0
                                                                ? ($color = 'btn-primary')
                                                                : ''))));
                                        @endphp
                                        {{-- ============================= --}}

                                        <button type="button" class="btn {{ $color }}">
                                            {{ $val['services_name'] }}
                                        </button>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                @php
                                    $ids = $item['id'];
                                @endphp
                                <form action="{{ route('admin.destroy.locket', $ids) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                        <button type="button" funct="editmodal" class="btn btn-secondary btn-sm"
                                            onclick="editmodal(this)" serv_value='{{ json_encode($item['service']) }}'
                                            value='["{{ $ids }}","{{ $item['name'] }}"]'>Edit</button>

                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada services</td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>
            {{-- __________________________________________________ --}}

            {{-- _____________Modal for edit ______________________ --}}
            <x-modal-update title="Edit Locket" action="{{ route('admin.locket.update') }}">
                <input type="hidden" name="id" id="ids">

                <div class="col-md-12">
                    <label for="inp" class="form-label">Edit Name</label>
                    <input type="text" class="form-control" id="inp" name="name" value="">
                </div>

                <br>
                {{--  --}}
                @foreach ($services_list as $item)
                    {{-- divider checkbox (3 per row) --}}
                    @if ($loop->iteration % 3 == 1)
                        <div class="btn-group col-md-12" role="group" aria-label="Basic checkbox toggle button group">
                    @endif

                    <input type="checkbox" class="btn-check checkbx " autocomplete="off" name="services[]"
                        id  = "{{ $item->services_name }}" value="{{ $item->id }}">

                    <label class="btn btn-outline-primary" for="{{ $item->services_name }}">
                        {{ $item->services_name }}
                    </label>


                    {{-- divider close tag |ignore weird @if position --}}
                    @if ($loop->iteration % 3 == 0 || $loop->last)
                        </div>
                    @endif

                @endforeach
        </x-modal-update>

        {{-- __________________________________________________ --}}

        <script>
            function editmodal(val) {// transfer data & display it on modal

                // ========= data initialize ===============
                var datas = JSON.parse(val.value);
                var serv = JSON.parse(val.getAttribute('serv_value'));

                // ========== form input=====================
                document.getElementById('ids').value = datas[0];
                document.getElementById('inp').value = datas[1];


                // ========= reset services checkbox ========
                const serviceCheckboxes = document.querySelectorAll('.checkbx');
                serviceCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });

                //========== servis checkbox checked ========
                serv.forEach(check => {
                    const matchingCheckbox = document.getElementById(check['services_name']);
                    if (matchingCheckbox) {
                        matchingCheckbox.checked = true;
                    }
                });

            };
        </script>


        </div>
    </main>
@endsection
