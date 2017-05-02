@extends('layouts.admin.a_master')
@section('title', 'Agregar actividad')
@section('description', 'Agregar nueva actividad')
@section('body_class', 'modulos session activity')
@section('breadcrumb_type', 'module session add activity')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_modules')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar actividad</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.modules.activities.form.activity-add-form')
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
