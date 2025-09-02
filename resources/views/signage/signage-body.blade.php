<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Signage</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="style.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .font {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v48/KFO7CnqEu92Fr1ME7kSn66aGLdTylUAMa3iUBGEe.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        /* Optional: Add a style to hide overflow for the running text container */
        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
        }

        #marquee-text {
            display: inline-block;
            /* Ensure it is an inline-block for transform to work correctly */
        }
    </style>
</head>

@yield('code')

<body class="sb-nav-fixed">
    <div id="layoutAuthentication">
        <main>
            <div class="container-fluid" style="height: 100vh">
                <div class="row" style="height: 100vh;">

                    {{-- audio library --}}
                    @include('signage.AudioLibrary')
                    {{-- queues display card --}}
                    @livewire('signage-card')

                    {{-- ------------------------------------------------------------- --}}

                    {{-- ------------------------------------------------------------- --}}

                    {{-- enterraiment display --}}
                    @yield('entertaiment')

                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    {{-- <script src="{{ asset('js/script.js') }}"></script> --}}
</body>

</html>
