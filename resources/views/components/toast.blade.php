@props([
    'from' => 'system',
])

<div aria-live="polite" aria-atomic="true" class="bg-body-secondary position-relative bd-example-toasts rounded-3" id="toast">
    <div class="top-0 start-0 toast-container p-3" id="toastPlacement">
      <div class="toast">
        <div class="toast-header --bs-primary">
          <strong class="me-auto">{{ $from }}</strong>
          <small>   </small>
        </div>
        <div class="toast-body">
          {{ $slot }}
        </div>
      </div>
    </div>
  </div>