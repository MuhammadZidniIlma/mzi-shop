<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="MZI-Shop">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    @notifyCss
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/more.css') }}" rel="stylesheet">
    <title>MZI Shop </title>
    <style>
        .notify {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
            display: flex;
            align-items: flex-start;
        }
    </style>
</head>

<body>

    <div class="preloader-container">
        <div class="preloader-text">
            <span>M</span><span>Z</span><span>I</span><span>-</span><span>S</span><span>H</span><span>O</span><span>P</span>
        </div>
    </div>
    <!-- Start Header/Navigation -->
    <x-navbar-home />
    <!-- End Header/Navigation -->


    <main>
        <x-notify::notify class="notify" />
        {{ $slot }}
    </main>

    <!-- Start Footer Section -->
    <x-footer-home />
    <!-- End Footer Section -->

    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/preloader.js') }}"></script>
    @notifyJs
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
</body>

</html>
