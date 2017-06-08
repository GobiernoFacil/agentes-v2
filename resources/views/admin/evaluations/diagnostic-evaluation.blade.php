@extends('layouts.admin.a_master')
@section('title', 'Evaluación diagnóstico de ' . $answers->user->name . ' ' . $answers->user->fellowData->surname )
@section('description', 'Evaluación diagnóstico de ' . $answers->user->name . ' ' . $answers->user->fellowData->surname )
@section('body_class', 'diagnostic')
@section('breadcrumb_type', 'diagnostic evaluation 1')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_diagnostic')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Evaluación diagnóstico de <strong>{{ $answers->user->name }} {{ $answers->user->fellowData->surname }} {{ $answers->user->fellowData->lastname }}</strong> (1/2)</h1>
	<div class="divider"></div>
  </div>
  <!--info fellow-->
	<div class="col-sm-1 center">
		@if($answers->user->image)
		<img src='{{url("img/users/{$answers->user->image->name}")}}' width="100%">
		@else
		<img src='{{url("img/users/default.png")}}' height="40px">
		@endif
	</div>
	<div class="col-sm-5">
		<p>{{$answers->user->fellowData->city}}, {{$answers->user->fellowData->state}}</p>
	</div>
	<div class="col-sm-3">
		<p>{{$answers->user->fellowData->origin}}</p>
	</div>
	<div class="col-sm-3">
		<p>Contestado <a title="{{date('d-m-Y H:i', strtotime($answers->created_at))}}">{{$answers->created_at->diffForHumans()}}</a></p>
	</div>
</div>

<div class="row">
  <div class="box">
    <div class="col-sm-10 col-sm-offset-1">
      @include('admin.evaluations.forms.diagnostic-evaluation-1-form')
    </div>
    <div class="clearfix"></div>
  </div>
</div>
@endsection
