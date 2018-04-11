@extends('layouts.admin.a_master')
@section('title', 'Ver perfil de ' . $userF->name)
@section('description', 'Ver perfil')
@section('body_class', 'fellow')

@section('content')
<div class="row">
	<div class="col-sm-12">
    	<h1>Ver perfil de <strong>
	    	@if($userF->type === 'fellow')
	    	Fellow
	    	@elseif($userF->type === 'facilitator')
	    	Facilitador
	    	@else
	    	Usuario
	    	@endif
    	</strong>
    	</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 center">
			@if($userF->type === 'fellow')
	    		@include('fellow.forums.forum-view-profile-fellow')
	    	@elseif($userF->type === 'facilitator')
	    		@include('fellow.forums.forum-view-profile-facilitator')
	    	@else
	    		@include('fellow.forums.forum-view-profile-admin')
	    	@endif
		</div>
	</div>
</div>
@endsection
