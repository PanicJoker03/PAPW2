@extends('layouts.master')
@section('content')
<div class="container container-post">
	<div class="post shadow">
		<div class="horizontal">
			<div class="vertical">
				<p class="post-title">{{$publicacion->titulo}}</p>
				<img src="{{ URL::asset($publicacion->contenidoRuta) }}" class="post-img one-edge-shadow">
			</div>
		</div>
	</div>
	<div class="comment-helper">
		<comentario-scroller 
			src="/comentario/publicacion/{{$publicacion->id}}/paginado" 
			usuario="{{Auth::user()->id}}"
			publicacion="{{$publicacion->id}}">		
		</comentario-scroller>
	</div>
</div>
@endsection