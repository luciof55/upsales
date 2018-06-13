@extends('layouts.app')
@section('header')
<ul class="navbar-nav mr-auto">
	@if (Gate::allows('module', 'businessrecords'))
		@if(Request::path() == 'businessrecords')
			<li class="nav-item nav-link active">@lang('messages.BusinessRecords')</li>
		@else
			<li class="nav-item"><a class="nav-link" href="{{route('main.businessrecords.index')}}">@lang('messages.BusinessRecords')</a></li>
		@endif
	@endif
</ul>
@endsection
@section('content')
<div class="row justify-content-center">
	<div class="col-md-2">
		<div class="d-none d-md-block navbar-expand-md">
			@include('actions', ['sourceUrl' => '/home', 'collapse' => '', 'navactions_id' => 'navactions'])
		</div>
	</div>
	<div class="col-md-10">
		<div class="card">
			@if (Gate::allows('module', 'principal'))
				@include('potencials.main')
			@else
				<div class="card-body"><div class="row"><div class="container">@include('common_status')</div></div></div>
			@endif
		</div>
	</div>
</div>
@endsection
@section('footer')
@include('footer')
@endsection
