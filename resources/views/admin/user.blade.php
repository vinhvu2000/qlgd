@extends('layouts.simple.master')

@section('title', 'Quarn lí người dùng')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Quản lí người dùng</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Quản lí người dùng</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row second-chart-list third-news-update">
	</div>
</div>
<script type="text/javascript">
	var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection

@section('script')
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
{{-- <script src="{{asset('assets/js/dashboard/default.js')}}"></script> --}}
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
@endsection
