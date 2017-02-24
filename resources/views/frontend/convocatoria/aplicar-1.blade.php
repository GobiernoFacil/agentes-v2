@extends('layouts.frontend.master')
@section('content')
@if(Session::has('success'))
  <div class="col-sm-12 message success">
      {{ Session::get('success') }}
  </div>
@endif
@include('frontend.convocatoria.forms.register')
@endsection
