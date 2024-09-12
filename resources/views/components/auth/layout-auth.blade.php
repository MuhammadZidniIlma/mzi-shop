<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V15</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @notifyCss
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assetLogin/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetLogin/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetLogin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetLogin/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetLogin/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetLogin/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetLogin/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetLogin/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetLogin/css/util.css">
    <link rel="stylesheet" type="text/css" href="assetLogin/css/main.css">
    <!--===============================================================================================-->

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
    <x-notify::notify />
    <div class="limiter">
        {{ $slot }}
    </div>


    @notifyJs
    <!--===============================================================================================-->
    <script src="assetLogin/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="assetLogin/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="assetLogin/vendor/bootstrap/js/popper.js"></script>
    <script src="assetLogin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="assetLogin/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="assetLogin/vendor/daterangepicker/moment.min.js"></script>
    <script src="assetLogin/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="assetLogin/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="assetLogin/js/main.js"></script>

</body>

</html>
