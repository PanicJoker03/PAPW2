@extends('layouts.master')
@section('content')
<crear-club-modal></crear-club-modal>
<div class="container">
	<div class="row">
		<div class="col-sm-3 hidden-xs">
			<div class="affix panel panel-default sidepanel">
				<div class="panel-heading">
					<a href="/usuario">
						<img src={{Auth::user()->avatarMinRuta}}>
					</a>
					ID de usuario: {{ Auth::id()}}
				</div>
				<div class="panel-body">
					Clubes que sigo...
{{-- 						@foreach ($misClubes as $club)
						{{$club}}
					@endforeach --}}
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-sm-push-6 hidden-xs">
			<div class="affix panel panel-default sidepanel">
				Nuevos grupos...
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