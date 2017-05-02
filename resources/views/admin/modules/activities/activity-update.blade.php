@extends('layouts.admin.a_master')
@section('title', 'Actualizar actividad')
@section('description', 'Actualizar nueva actividad')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Actualizar actividad</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.activities.form.activity-update-form')
    </div>
  </div>
</div>
@endsection
@section('js-content')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
$( document ).ready(function() {
    $('#type').change(function(){
      if(this.value==='evaluation'){
        $('#user-file').show();
      }else{
        $('#user-file').hide();
      }
    });
});
</script>
@endsection
