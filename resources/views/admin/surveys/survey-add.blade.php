@extends('layouts.admin.a_master')
@section('title', 'Respuestas de encuesta de satisfacción de ')
@section('description', 'Respuestas de encuesta de satisfacción de ' )
@section('body_class', 'survey')
@section('breadcrumb_type', 'survey  view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_survey')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Agregar encuesta</h1>
    <p>{{$program->title}}</p>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('admin.surveys.forms.survey-add-form')
    </div>
  </div>
</div>
@endsection

@section('js-content')
<script>
  $( document ).ready(function() {
    $('#type').change(function(){
      if(this.value==='facilitator'){
        $('#facilitator_name').show();
      }else{
        $('#facilitator_name').hide();
        $('#facilitator_name').val("0");
      }
    });
  });
</script>
@endsection
