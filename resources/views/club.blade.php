@extends('layouts.master')
@section('content')
<div class="container">
	<crear-publicacion-modal 
		club={{ $club->id }}
		nombre-club="{{ $club->nombreClub }}"
		autor-club={{ $club->creador }}>
	</crear-publicacion-modal>
	<div class="club-header one-edge-shadow">
		<img src="{{URL::asset($club->avatarRuta)}}">
		<div class="club-title">
			<p>{{$club->nombreClub}}</p>
		</div>
	</div>
	<div>
	@if ($club->creador == $usuario_id)
		Es mi club
	@else
		<boton-subscripcion
			@if(isset($subscripcion))
			id={{$subscripcion->id}}
			@else
			id='-1'
			@endif
			club={{ $club->id }}>
		</boton-subscripcion>
	@endif
	</div>
	<div class="row">
		<div class="col-sm-3 col-sm-push-9 hidden-xs">
			<div class="sidepanel">
				<a class="btn btn-primary" data-toggle="modal" data-target="#crearPublicacionModal"><span class = "glyphicon glyphicon-plus">&nbsp;</span>Compartir imagen</a>
			</div>
			<div class="list-group sidepanel">
				<li class="list-group-item">Ultima actividad (comenantarios, likes)</li>
			</div>
		</div>
		<div class="col-sm-9 col-sm-pull-3 container-diver shadow">
			<publicacion-scroller src="/publicacion/club/{{$club->id}}/paginado"></publicacion-scroller>
		</div>
	</div>
</div>
@endsection