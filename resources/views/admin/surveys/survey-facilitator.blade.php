@extends('layouts.admin.a_master')
@section('title', 'Resultados de encuesta por sesión de ' . $facilitatorData->facilitator->name)
@section('description', 'Resultados de encuesta por sesión de ' . $facilitatorData->facilitator->name.' sesión '.$facilitatorData->session->name)
@section('body_class', '')

@section('content')
@endsection
