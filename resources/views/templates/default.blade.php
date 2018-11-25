<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<title> @yield('title', env('APP_NAME')) </title>

	<link rel="stylesheet" href="{{  mix('/css/app.css') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


	{{-- <link rel="manifest" href="{{ asset("manifest.json") }}">  --}}
	
	{{-- favicons --}}
	@include("templates.parts.favicons") 
	@yield("head")

	<script>
		window.Rosa = {!! json_encode([
			'url'       	=> url('/'),
		]) !!}
	</script>
</head>
<body class='@yield("page")'>

	{{-- Static content --}}
	@yield("static")
	
	{{-- Dynamic content --}}
	@hasSection("content")
	<div id="rosa-app">
		@yield('content')
	</div>
	@endif

	{{-- Main scripts, vendor dependencies and manifest --}} 
	@yield('scripts')

	@hasSection("content")
	<script src="{{ asset('js/manifest.js') }}" defer></script>
	<script src="{{ asset('js/vendor.js') }}" defer></script>
	<script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
	@endif
</body>
</html>