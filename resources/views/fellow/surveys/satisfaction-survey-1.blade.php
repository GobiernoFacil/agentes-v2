@extends('layouts.admin.a_master')
@section('title', '' )
@section('description', '')
@section('body_class', 'fellow')

@section('content')
<div class="box">
  <div class ="row">
    <div class= "col-sm-12">
      @include('fellow.surveys.forms.satisfaction-form-1')
    </div>
  </div>
</div>
@endsection
