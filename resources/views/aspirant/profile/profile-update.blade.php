@extends('layouts.admin.fellow_master')
@section('title', 'Editar tu Perfil')
@section('description', 'Editar tu perfil')
@section('body_class', 'profile')
@section('breadcrumb_type', 'profile edit')
@section('breadcrumb', 'layouts.aspirant.breadcrumb.b_profile')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Edita tu perfil</h1>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			@include('aspirant.profile.forms.profile-update-form')
		</div>
	</div>
</div>
@endsection