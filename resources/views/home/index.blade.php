@extends('home.layout')

@section('content')

    <div class="gb-content">
		<!--CONTENT-->
		<div class="Content-Main">
		    @include('home.main.slide')
		    @include('home.main.banner')
		    @include('home.main.search')
		    @include('home.main.product')
		    @include('home.main.news')
		    @include('home.main.banner2')
		</div>
	</div>

@endsection