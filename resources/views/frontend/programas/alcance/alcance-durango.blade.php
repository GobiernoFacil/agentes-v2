@extends('layouts.frontend.master')
@section('title', 'Durango, ejercicio local de Gobierno Abierto')
@section('description', 'El 9 de marzo de 2015, el estado de Durango se integró formalmente a los Ejercicios Locales de Gobierno Abierto a través de la firma de la Declaración Conjunta para la Implementación de las Acciones para un Gobierno Abierto')
@section('body_class', 'programa alcance durango')
@section('canonical', url('programa-gobierno-abierto/alcance/durango') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_programa')

@section('content')

<?php $include_state = "ejercicio_durango";?>
@include('frontend.programas.alcance.includes.card_layout')

@endsection

@section('js-content')
<script src="{{ url('js/bower_components/underscore/underscore-min.js') }}"></script>
<script src="{{ url('js/bower_components/d3/d3.min.js') }}"></script>
<script src="{{ url('js/vue.min.js') }}"></script>
<script>
  var Format       = d3.format(",2"),
      FormatDe     = d3.format(",.2f"),
      currentState = "{{$state}}";
  </script>
  <script src="{{ url('js/indicadores/main.js')}}"></script>
@endsection