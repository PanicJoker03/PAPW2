@extends('layouts.master')
@section('content')
<div class="container">
	<crear-publicacion-modal 
		club={{ $club->id }}
		nombre-club="{{ $club->nombreClub }}">
	</crear-publicacion-modal>
	<div class="row">
		<div class="col-sm-3 hidden-xs">
			<div class="panel panel-default sidepanel pull-right">
				<div class="panel-heading">
					{{ $club->nombreClub }}
				</div>
				<div class="panel-body">
					<img src={{ URL::asset($club->avatarRuta) }} class="img-rounded">
					<p> {{ $club->descripcion }} </p>
				</div>
				<div class="panel-footer">
					<a class="btn btn-primary" data-toggle="modal" data-target="#crearPublicacionModal"><span class = "glyphicon glyphicon-plus">&nbsp;</span>Compartir imagen</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-sm-push-6 hidden-xs">
			<div class="list-group sidepanel">
				<li class="list-group-item">Ultima actividad (comenantarios, likes)</li>
			</div>
		</div>
		<div class="col-sm-6 col-sm-pull-3">
			<div class="row">
				@foreach ($publicaciones as $publicacion)
				<div class="col-md-4 col-sm-6 col-xs-4">
					<img src="{{ URL::asset($publicacion->contenidoMinRuta) }}" width="100%" height="auto">
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection