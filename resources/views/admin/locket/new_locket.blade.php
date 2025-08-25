@extends('layouts.body')
@section('title', 'admin locket')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Locket" breadcrumb="locket/create" href="/admin/locket" button="back"></x-breadcrumb>
            {{-- form --}}
            @if (!$services_list->isEmpty())
                <x-form method="POST" route="{{ route('admin.locket.store') }}">
                    <x-form-input name="name"></x-form-input>

                    @foreach ($services_list as $item)
                        @if ($loop->iteration % 2 == 1)
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        @endif

                        <input type="checkbox" class="btn-check" id="{{ $item->services_name }}" name="services[]"
                            autocomplete="off" value="{{ $item->id }}">
                        <label class="btn btn-outline-primary"
                            for="{{ $item->services_name }}">{{ $item->services_name }}</label>
                        @if ($loop->iteration % 2 == 0 || $loop->last)
        </div>
        @endif
        @endforeach


        </x-form>
    @else
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Info!</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             Please make a service first before making a new locket
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="window.location.href='/admin/services';">make new services</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


        @endif
        <script>
            // Wait for the DOM to be fully loaded
            document.addEventListener('DOMContentLoaded', (event) => {
                // Find the modal element by its ID
                var myModal = new bootstrap.Modal(document.getElementById('myModal'));

                // Show the modal
                myModal.show();
            });
        </script>

        {{-- ========== --}}
        </div>
    </main>
@endsection
