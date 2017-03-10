@extends('layouts.master')
@section('content')
<div class="container">
	<crear-publicacion-modal></crear-publicacion-modal>
	<div class="row">
		<div class="col-sm-3 hidden-xs">
			<div class="affix panel panel-default sidepanel">
				<div class="panel-heading">
					{{ $club->nombreClub }}
				</div>
				<div class="panel-body">
					<img src={{ URL::asset($club->avatarRuta) }} class="img-rounded">
					<p> {{ $club->descripcion }} </p>
				</div>
				<div class="panel-footer">
					<a class="btn btn-primary" href="/publicacion/crear" data-toggle="modal" data-target="#crearPublicacionModal"><span class = "glyphicon glyphicon-plus">&nbsp;</span>Compartir imagen</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-sm-push-6 hidden-xs">
			<div class="affix list-group sidepanel">
				<li class="list-group-item">Ultima actividad (comenantarios, likes)</li>

			</div>
		</div>
		<div class="col-sm-6 col-sm-pull-3">
			<div class="row">
				@for ($i = 0; $i < 15; $i++)
				<div class="panel panel-default">
					<div class="panel panel-heading">
						Publicación {{$i}}
						<br>
					</div>
					<div class="panel panel">
						Aquí va a haber contenido...
					</div>
				</div>
				@endfor
			</div>
		</div>
	</div>
</div>
@endsection