@extends('layouts.admin.a_master')
@section('title', $content->title)
@section('description', $content->title)
@section('body_class', 'news')
@section('breadcrumb_type', 'news view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_news')

@section('content')

<div class="box">
	<div class="row">
		@include('layouts.news.view-news')
	</div>
</div>
@endsection
