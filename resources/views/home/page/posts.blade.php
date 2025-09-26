@extends('home.layout')

@section('content')
<div class="gb-content">
@include('home.other.breadcrumb')

<div class="gb-page-blog_ruouvang">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                        @foreach ($posts as $post)
                                        <div class="col-sm-6">
                        <div class="gb-news-blog_ruouvang-item">
                            <div class="gb-news-blog_ruouvang-item-img">
                                <a href="/tin-tuc/{{ $post->slug }}"><img src="/storage/uploads/post/{{ $post->image }}" alt="{{ $post->title }}" class="img-responsive"></a>
                                <div class="caption caption-large">
                                    <time class="the-date">{{ date("Y-m-d", strtotime($post->created_at)) }}</time>
                                </div>
                            </div>
                            <div class="gb-news-blog_ruouvang-item-text">
                                <div class="gb-news-blog_ruouvang-item-title">
                                    <h3><a href="/tin-tuc/{{ $post->slug }}">{{ $post->title }}</a></h3>
                                </div>
                                <div class="gb-news-blog_ruouvang-item-text-des">
                                    <p>{{ $post->description }}</p>
                                </div>
                            </div>
                            <div class="gb-news-blog_ruouvang-item-button">
                                <a href="/tin-tuc/{{ $post->slug }}">
                                    <button type="button" class="btn gb-btn-readmore">ĐỌC TIẾP</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                                  </div>
                <div style="text-align: center;">
                    {{  $posts->links('pagination') }}
                </div>
            </div>
            <div class="col-md-4">
                @include('home.sidebar.sidebar_news')
            </div>
        </div>
    </div>
</div>
</div>
@endsection
    