@extends('layouts.master')
@section('content')
<div class="container">
	<crear-publicacion-modal 
		club={{ $club->id }}
		nombre-club="{{ $club->nombreClub }}">
	</crear-publicacion-modal>
	<div class="club-header one-edge-shadow">
		<img src="{{URL::asset('images/header.jpg')}}">
		<div class="club-title">
			<p>{{$club->nombreClub}}</p>
		</div>
	</div>
	<div class="row">
		<!-- <div class="col-sm-3 hidden-xs">
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
		</div> -->
		<div class="col-sm-3 col-sm-push-9 hidden-xs">
			<div class="sidepanel">
				<a class="btn btn-primary" data-toggle="modal" data-target="#crearPublicacionModal"><span class = "glyphicon glyphicon-plus">&nbsp;</span>Compartir imagen</a>
			</div>
			<div class="list-group sidepanel">
				<li class="list-group-item">Ultima actividad (comenantarios, likes)</li>
			</div>
		</div>
		<div class="col-sm-9 col-sm-pull-3 container-diver shadow">
{{-- 			<div class="row">
				@foreach ($publicaciones as $publicacion)
				<div class="col-md-3 col-sm-4 col-xs-3 one-edge-shadow">
					<img src="{{ URL::asset($publicacion->contenidoMinRuta) }}" width="100%" height="auto">
				</div>
				@endforeach
			</div> --}}
			{{-- El código del formato de la thumbnail de la publicacion se encuentra en PublicacionScroller.vue --}}
			<publicacion-scroller src="/publicacion/club/{{$club->id}}/paginado"></publicacion-scroller>
		</div>
	</div>
</div>
@endsection