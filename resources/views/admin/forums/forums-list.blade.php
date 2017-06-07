@extends('layouts.admin.a_master')
@section('title', $forum->topic )
@section('description',$forum->topic )
@section('body_class', 'foros')
@section('breadcrumb_type', 'forum view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_forums')

@section('content')
@include('layouts.forums.list')
@endsection