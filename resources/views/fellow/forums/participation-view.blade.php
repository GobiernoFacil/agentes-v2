@extends('layouts.admin.a_master')
@section('title', 'Lista de participaciones' )
@section('description', 'Lista de participaciones')
@section('body_class', 'fellow aprendizaje')

@section('content')
@if($modules->count() > 0)
<div class="row">
	<div class="col-sm-12">
		<h1>Participaciones</h1>
		<p>En este apartado podrás consultar los foros en los que has participado.</p>

		<?php $count_modules = 1; ?>
		@foreach ($modules as $module)
		<div class="box">
		  <h1 class="center">Módulo {{$count_modules}}: <strong>{{$module->title}}</strong></h1>
			  @if($module->get_all_activities_with_forums()->count()>0)
					@include('fellow.forums.includes.module-participation')
				@else
				<h2 class="center">Sin foros</h2>
			@endif
			<?php $count_modules++;?>
		</div><!-- box ends-->
		@endforeach
   </div>
	 {{ $modules->links() }}
</div>
@else
<div class="row">
	<div class="col-sm-9">
		<h1>Participaciones</h1>
	</div>
</div>
<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
		<h2>Sin información</h2>
		</div>
	</div>
</div>
@endif
@endsection
