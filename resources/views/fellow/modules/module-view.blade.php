@extends('layouts.admin.a_master')
@section('title', $module->title )
@section('description', $module->objective)
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'module view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')

@section('content')

<div class="ap_when">
	<p><b class="danger"></b><strong>Fecha límite</strong>: Debes cumplir con esta tarea el {{date("d-m-Y", strtotime($module->end))}}, 11:59 pm, hora de la Ciudad de México ({{ \Carbon\Carbon::createFromTimeStamp(strtotime($module->end))->diffForHumans()}}) </p>
</div>



<!-- title -->
<div class="row">
	<div class="col-sm-12">
		<h1>{{$module->title}}</h1>
		<p class="ap_objective"><strong>Objetivo:</strong> {{$module->objective}}</p>
	</div>
	@if($module->sessions->count() > 0)
	<div class="col-sm-3">
		<p><strong>Facilitadores:</strong></p>
	</div>
	<div class="col-sm-9">
		@foreach($module->sessions as $session)
		 	@if($session->facilitators->count() > 0)
				@foreach ($session->facilitators as $facilitator)
					<div class="ap_facilitator_list" data-name="{{$facilitator->user->name}}">
						<figure>
							@if($facilitator->user->image)
							<img src='{{url("img/users/{$facilitator->user->image->name}")}}' height="45px">
							@else
							<img src='{{url("img/users/default.png")}}' height="45px">
							@endif		
						</figure>		
					</div>
				@endforeach
			@endif
		@endforeach
	</div>
	@endif
</div>

<!-- lista de sesiones-->
@if($module->sessions->count() > 0)
<div class="box session_list last_activity ap_week">
    @foreach($module->sessions as $session)
    <h2><a href='{{ url("tablero/aprendizaje/{$module->slug}/{$session->slug}") }}'>{{$session->name}}</a></h2>
    @if($session->activities->count() > 0)
    <ul class="ap_list">
    	@foreach ($session->activities as $activity)
    	<li class="row">
    		<span class="col-sm-9">
    			<b class="{{$activity->type}}"><span class="{{ $activity->type == "video" ? 'arrow-right' : '' }}"></span></b>
    			<a href="{{ url('tablero/aprendizaje/'. $session->module->slug .'/'. $session->slug .'/' . $activity->id) }}">{{$activity->name}} <span class="notes">{{$activity->duration}} min.</span></a> 
    		</span>
    		@if($activity->type == "evaluation")
    		<span class="col-sm-3">
    			<p class="right"> Fecha límite:
    			 <strong>{{date("d-m-Y", strtotime($activity->end))}}</strong><br>
    			 <span class="notes">({{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->end))->diffForHumans()}})</span>
    			</p>
    		</span>
    		@endif
    	</li>
    	@endforeach
    </ul>
    @endif
    
    @endforeach
</div>
@else
<div class="box">
	<div class="row center">
		<h2>Sin sesiones</h2>
	</div>
</div>
@endif

@endsection
