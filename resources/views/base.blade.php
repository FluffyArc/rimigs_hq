<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Rimigs HQ</title>

    <link href="{{asset('css/client.css')}}" rel="stylesheet"/>





</head>
<body>
<!-- TOP NAV -->
@yield('navclient')
<div class="container">
    @yield('content')
</div>
<!-- END NAV -->







</body>
</html>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

