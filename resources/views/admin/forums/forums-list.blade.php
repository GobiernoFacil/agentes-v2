@extends('layouts.admin.a_master')
@section('title', $forum->topic )
@section('description',$forum->topic )
@section('body_class', 'foros')
@section('breadcrumb_type', '')

@section('content')
@include('layouts.forums.list')
@endsection