@extends('layouts.admin.a_master')
@section('title',  $question->topic)
@section('description', 'Ver foro')
@section('body_class', 'foros')
@section('breadcrumb_type', 'forum question view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_forums')

@section('content')
@include('layouts.forums.question-view')
@endsection