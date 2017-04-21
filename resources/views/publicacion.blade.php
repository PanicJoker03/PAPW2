@extends('layouts.master')
@section('content')
<div class="container">
	<div>
		<img src="{{ URL::asset($publicacion->contenidoRuta) }}">
	</div>
	<div>
{{-- 		@foreach ($comentarios as $comentario)
			<div class="panel">
				<img class="pull-left" src="{{ URL::asset($comentario->avatarMinRuta) }}">
				<h4>{{$comentario->nombreUsuario}}</h4>
				<p>{{$comentario->comentario}}</p>
			</div>
		@endforeach --}}
		<comentario-scroller 
			src="/comentario/publicacion/{{$publicacion->id}}/paginado" 
			usuario="{{Auth::user()->id}}"
			publicacion="{{$publicacion->id}}">		
		</comentario-scroller>
	</div>
</div>
@endsection