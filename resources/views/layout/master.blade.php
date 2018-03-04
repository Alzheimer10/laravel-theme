<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
	<meta charset="utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href="">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ Config::get('app.name') }} | @yield('title') </title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!-- Bootstrap core CSS     -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/paper-kit.css?v=2.1.0') }}" rel="stylesheet"/>

	<!--  CSS for Demo Purpose, don't include it in your project     -->
	<link href="{{ asset('css/demo.css') }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,300,700" rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet">

</head>
<body>

    @include('layout.navbar')
      <!-- content -->
      @yield('content')
      <!-- content-end -->

    @include('layout.footer')
    
</body>

<!-- Core JS Files -->
<script src="{{asset('js/jquery-3.2.1.js') }}" type="text/javascript"></script>
<script src="{{asset('js/jquery-ui-1.12.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{asset('js/popper.js') }}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- Switches -->
<script src="{{asset('js/bootstrap-switch.min.js') }}"></script>

<!--  Plugins for Slider -->
<script src="{{asset('js/nouislider.js') }}"></script>

<!--  Plugins for DateTimePicker -->
<script src="{{asset('js/moment.min.js') }}"></script>
<script src="{{asset('js/bootstrap-datetimepicker.min.js') }}"></script>

<!--  Paper Kit Initialization snd functons -->
<script src="{{asset('js/paper-kit.js?v=2.1.0') }}"></script>

</html>
