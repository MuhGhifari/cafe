<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>
	 <!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Styles -->
   @include('partials.css')
   <style type="text/css">
   	a.keranjang span{
   		height: 13px;
   		width: 13px;
   		background: #7fad39;
   		font-size: 10px;
   		color: #ffffff;
   		line-height: 13px;
   		text-align: center;
   		font-weight: 700;
   		display: inline-block;
   		border-radius: 50%;
   		position: absolute;
   		top: 0;
   		right: -12px;
   	}
   </style>
   @yield('stylesheets')
</head>
<body>
      @include('partials.modal')
	  	@include('partials.nav')
		@yield('content')
      @include('partials.footer')
</body>
 	<!-- Scripts -->
 	@include('partials.js')
 	@yield('scripts')
</html>
