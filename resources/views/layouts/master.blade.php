<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Inicio</title>
	{{-- <link rel="stylesheet" type="text/css" href="css/theme.min.css"> --}}
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="/css/jquery.crop.css">
	<link rel="stylesheet" type="text/css" href="/css/diver.css">
</head>
<body>
<div id="app">
	<crear-club-modal></crear-club-modal>
	@include('barraNavegacion')
	@yield('content')
</div>
</body>
<script>
	window.Laravel = {"csrfToken" : "{{ csrf_token() }}" };
</script>
<script type="text/javascript" src="/js/app.js"></script>
</html>