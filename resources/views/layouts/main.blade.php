<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>

</head>
<body>

    <!-- Navbar -->
    @include('components.navbar')
    {{-- script untuk js dan demos js --}}
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/datables-simple-demo.js') }}"></script>
    <script src="{{ asset('demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('demo/datatables-demo.js') }}"></script>
</body>
</html>
