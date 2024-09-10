<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="MZI-Shop">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    @notifyCss
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/more.css') }}" rel="stylesheet">
    <title>MZI Shop </title>
</head>

<body>

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

    @notifyJs
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</body>

</html>
