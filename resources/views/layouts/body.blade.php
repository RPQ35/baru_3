<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <title>@yield('title', 'My App')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 80px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider knob */
        .slider {
            border-radius: 10px;
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
            @apply rounded-full;
        }

        /* The circular knob */
        .slider:before {
            position: absolute;
            border-radius: 14px;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            @apply rounded-full;
        }

        /* Change background color when checked */
        input:checked+.slider {

            background-color: #2563eb;
        }

        /* Move the knob when checked */
        input:checked+.slider:before {
            -webkit-transform: translateX(46px);
            -ms-transform: translateX(46px);
            transform: translateX(46px);
        }
    </style>
</head>


<body>

    <!-- Navbar -->

    <body class="sb-nav-fixed">

        {{-- top nav --}}
        @include('layouts.top-nav')

        <div id="layoutSidenav">
            {{-- side nav --}}
            @include('layouts.sidebar')
            {{-- =================== --}}
            <div id="layoutSidenav_content">
                {{-- main --}}
                @yield('main')
                {{-- ======== --}}

                {{-- footer --}}
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2025</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
                {{-- ================= --}}
            </div>
        </div>

    </body>
    {{-- script untuk js dan demos js --}}
    {{-- script untuk js dan demos js --}}
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    {{-- <script src="{{ asset('demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('demo/datatables-demo.js') }}"></script>

    {{-- script sisanya --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
