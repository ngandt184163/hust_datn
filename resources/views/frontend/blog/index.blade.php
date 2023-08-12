@extends('frontend.layouts.master')
@section('title_page','Blog')
@section('content')
    <section>
        <div class="gap2 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row merged20" id="page-contents">
                            <div class="col-lg-12">
                                <div class="central-meta">
                                    <div class="title-block">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <div class="align-left">
                                                    <h5>Blog <span>{{ isset($articles) ? $articles->count() : 0 }}</span></h5>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <form method="get">
                                                    <input name="k" value="{{ Request::get('k') }}" type="text" placeholder="Search name">
                                                    <button type="submit"><i class="fa fa-search"></i></button>
                                                </form>
                                            </div>
                                            <div class="col-lg-6">
                                                <a style="padding: 10px 10px; box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.3);" href="{{ route('get.blog.chia_se_kinh_nghiem') }}" title="" >Chia sẻ kinh nghiệm</a>
                                                <a style="padding: 10px 10px; box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.3);" href="{{ route('get.blog.hoi_dap') }}" title="" >Hỏi đáp</a>
                                                <a style="padding: 10px 10px; box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.3);" href="{{ route('get.blog.cho_nhan') }}" title="" >Cho nhận</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- title block -->
                                <div id="article-blog" class="article-list articleDetailContainer row merged20">
                                    @foreach($articles ?? [] as $item)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="central-meta">
                                            <div class="blog-post">
                                                <div class="friend-info">
                                                    <figure>
                                                        <img style="width: 40px;height: 40px;border-radius: 50%;object-fit: cover" src="{{ pare_url_file($item->user->avatar ?? "") }}" alt="">
                                                    </figure>
                                                    <div class="friend-name">
                                                        <ins><a href="{{ route('get.profile.detail', $item->user_id) }}" title="{{ $item->user->name ?? "" }}">Hi  {{ $item->user->name ?? "" }}</a></ins>
                                                        <span><i class="fa fa-globe"></i> published: {{ $item->created_at }} </span>
                                                    </div>
                                                    <div class="post-meta">
                                                        <figure>
                                                            {{-- <a title="" href="{{ route('get.blog.detail', $item->id) }}">
                                                                <img style="height: 300px" src="{{ pare_url_file($item->avatar) }}" alt="">
                                                            </a> --}}
                                                            <a data-id="{{ $item->id }}" class="view-detail-btn" title="">
                                                                @if ($item->video)
                                                                    <video class="video" id="{{ $item->id }}" data-id="{{ $item->id }}" width="100%" height="300px" controls>
                                                                        <source src="{{ pare_url_file($item->video) }}" type="video/mp4">
                                                                    </video>
                                                                @else
                                                                        <img src="{{ pare_url_file($item->avatar) }}" style="height: 300px" alt="">
                                                                @endif
                                                            </a>
{{--                                                            <ul class="like-dislike">--}}
{{--                                                                <li><a title="Save to Pin Post" href="#" class="bg-purple"><i class="fa fa-thumb-tack"></i></a></li>--}}
{{--                                                                <li><a title="Like Post" href="#" class="bg-blue"><i class="ti-thumb-up"></i></a></li>--}}
{{--                                                                <li><a title="dislike Post" href="#" class="bg-red"><i class="ti-thumb-down"></i></a></li>--}}
{{--                                                            </ul>--}}
                                                        </figure>
                                                        <div class="description">
                                                            <a data-ripple="" class="learnmore view-detail-btn" data-id="{{ $item->id }}" class="view-detail-btn">Chi tiết</a>
                                                            <h2 style="min-height: 55px"><a data-id="{{ $item->id }}" class="view-detail-btn" title="">{{ $item->name }}</a></h2>
                                                            <p style="min-height: 52px">{{ $item->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div><!-- centerl meta -->
                        </div>
                    </div>
                </div>
                {{-- <div class="row"> --}}
                    <div class="loadMore">
                        <button id="loadMoreBtn" class="btn-view btn-load-more justify-content-center">Load More</button>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </section>

    @include('frontend.home.modal_show_article_detail');
@stop
