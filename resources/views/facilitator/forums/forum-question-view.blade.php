@extends('layouts.admin.a_master')
@section('title',  $question->topic)
@section('description', 'Ver foro')
@section('body_class', 'facilitator foros')
@section('breadcrumb_type', 'forum view')

@section('content')

@include('layouts.forums.question-view')

@endsection