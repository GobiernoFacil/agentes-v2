@extends('layouts.admin.a_master')
@section('title', 'Agregar usuario administrador')
@section('description', 'Agregar nuevo usuario administrador | Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')

@section('content')
  @include('suAdmin.users.forms.admin-add-form')
@endsection
