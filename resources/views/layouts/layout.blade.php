<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon.png')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Sistem Informasi KRS Laravel</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{asset('css/paper-dashboard.css')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('css/demo.css')}}" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet">

</head>
<body>

<div class="wrapper">
@include('layouts.sidebar')
    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    <div class="main-panel" @if(!Auth::check()) style="width:100%" @endif>
    @if(Auth::check())
    @include('layouts.header')
    @endif
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('info'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-right:30px;"><span aria-hidden="true">&times;</span></button>
                                {{ session('info') }}
                            </div>
                        @endif
                    </div>
                </div><!--/.row-->
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>

    @include('layouts.footer')


    </div>
</div>


</body>
    @section('js')
    <!--   Core JS Files   -->
    <script src="{{asset('js/jquery-1.10.2.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="{{asset('js/bootstrap-checkbox-radio.js')}}"></script>

	<!--  Charts Plugin -->
	<script src="{{asset('js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('js/bootstrap-notify.js')}}"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js')}}"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="{{asset('js/paper-dashboard.js')}}"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="{{asset('js/demo.js')}}"></script>
    @show

</html>
