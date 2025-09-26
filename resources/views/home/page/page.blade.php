@extends('home.layout')

@section('content')
<div class="gb-content">
<div class="gb-page-gioithieu">
    @include('home.other.breadcrumb')
    <div class="container">
        <div class="gb-page-gioithieu-right">
            <h2 style="font-size: 2em;">{{ $page_item->title }}</h2>
            {!! $page_item->content !!}
        </div>
    </div>
</div>
</div>
@endsection
    