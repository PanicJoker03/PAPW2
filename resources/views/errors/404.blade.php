{{-- Este view se mandara a llamar cada vez que exista una excepcion de 404 --}}
<!DOCTYPE html>
<html>
<head>
	<title>Página no encontrada</title>
	{{-- <link rel="stylesheet" type="text/css" href="css/theme.min.css"> --}}
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="/css/jquery.crop.css">
	<link rel="stylesheet" type="text/css" href="/css/diver.css">
</head>
<body>
<div id="app">
	<div class="container">
		<h1>Error 404:</h1>
		<h2>Ups... al parecer la página que buscas no se encuentra :(</h2>
	</div>
</div>
</body>
<script>
	window.Laravel = {"csrfToken" : "{{ csrf_token() }}" };
</script>
<script type="text/javascript" src="/js/app.js"></script>
</html>