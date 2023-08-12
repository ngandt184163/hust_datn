@extends('frontend.layouts.master')
@section('content')
<div class="gap2 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row merged20" id="page-contents">
                    <div class="col-lg-6 offset-2">
                        <div class="central-meta" style="display: flex;justify-content: space-between">
                            <a style="{{ ($subPath == '') ? 'color: #fa6342' : '' }} " class="a_tag active" href="/"  class="" title="">
                                <i class="fa fa-pencil"></i> Bài viết
                            </a>
                            <a style="{{ ($subPath == 'video') ? 'color: #fa6342' : '' }} " class="a_tag" href="{{ route('get.video') }}" class=""   title="">
                                <i class="fa fa-video"></i> Video
                            </a>
                            <a style="{{ ($subPath == 'kham-pha') ? 'color: #fa6342' : '' }} " class="a_tag" href="{{ route('get.kham_pha')}}" title="">
                                <i class="fa fa-map"></i> Khám phá
                            </a>
                        </div>
                        <div class="central-meta article-list articleDetailContainer">
                            <span class="create-post">Hot Article</span>
                            <ul style="height: 130px" class="promo-caro">
                                @foreach($articles_hot ?? [] as $item)
                                <li  style="width: 170px; height: 140px; overflow: hidden;">
                                    <a data-id="{{ $item->id }}" class="view-detail-btn">
                                        {{-- <img src="{{ pare_url_file($item->video) ?? pare_url_file($item->avatar) }}" alt=""> --}}
                                        @if ($item->video)
                                            <video class="video" id="{{ $item->id }}" data-id="{{ $item->id }}" width="100%" height="138" controls>
                                                <source src="{{ pare_url_file($item->video) }}" type="video/mp4">
                                            </video>
                                        @else
                                            {{-- <a href="" style="margin-bottom: 10px;display: block"> --}}
                                                <img style="width: 100%; height: 138px;" src="{{ pare_url_file($item->avatar) }}" style="width: 100%;height: auto" alt="">
                                            {{-- </a> --}}
                                        @endif
                                    </a>
                                    <div class="promo-meta">
                                        <a href="{{ route('get.story.detail', $item->id) }}" title=""></a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div><!-- suggested friends -->
                        <div class="central-meta">
                            <span class="create-post">Hot Pet</span>
                            <div class="story-postbox">
                                <ul class="promo-caro">
                                    @foreach($pets ?? [] as $item)
                                    <li>
                                        <a href="{{ route('get.pet.detail', $item->id) }}">
                                            <img src="{{ pare_url_file($item->avatar) }}" alt=""
                                            style=" width: 120px;
                                                    height: 120px;
                                                    display: block;
                                                    border-radius: 50%;
                                                    object-fit: cover;">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>

{{--  --}}
                            </div>
                        </div><!-- top stories -->
                        <div class="article-list articleDetailContainer add-article loadMore">
                            {{-- {{ $articles }} --}}
                            @foreach($articles ?? [] as $item)
                            <div class="central-meta item">
                                <div class="user-post">
                                    <div class="friend-info">
                                        <figure>
                                            <img style="width: 40px;height: 40px;border-radius: 50%;object-fit: cover" src="{{ pare_url_file($item->user->avatar ?? "") }}" alt="">
                                        </figure>
                                        <div class="friend-name">
                                            <div class="more">
                                                <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                    <ul>
                                                        <li>
                                                            {{-- <a href="{{ route('get.article.detail', $item->id) }}">
                                                                <i class="fa fa-pencil-square-o"></i> Chi tiết
                                                            </a> --}}
                                                            <button data-id="{{ $item->id }}" class="view-detail-btn"><i class="fa fa-pencil-square-o"></i> Chi tiết</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <ins><a href="{{ route('get.profile.detail', $item->user_id) }}" title="{{ $item->user->name ?? "" }}">Hi  {{ $item->user->name ?? "" }}</a></ins>
                                            <span><i class="fa fa-globe"></i> published: {{ $item->created_at }} </span>
                                        </div>
                                        <div class="post-meta">
                                            <figure>
                                                <div class="img-bunch">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <figure>
                                                                <a data-id="{{ $item->id }}" class="view-detail-btn" title="">
                                                                    @if ($item->video)
                                                                        <video class="video" id="{{ $item->id }}" data-id="{{ $item->id }}" width="100%" height="240" controls >
                                                                            <source src="{{ pare_url_file($item->video) }}" type="video/mp4">
                                                                        </video>
                                                                    @else
                                                                        <img src="{{ pare_url_file($item->avatar) }}" style="width: 100%;height: auto" alt="">
                                                                    @endif
                                                                </a>
                                                            </figure>
                                                            <div class="we-video-info">
                                                                <ul>
                                                                    <li>
                                                                        <div class="likes heart" title="Like/Dislike">
                                                                            <a data-article-id="{{ $item->id }}" class="like-article like like_out" onclick="toggleClass(this)" " href="#">❤</a>
                                                                            <span id="total_like_{{ $item->id }}">{{ $item->total_like }}</span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <span class="comment" title="Comments">
                                                                            <i class="fa fa-commenting"></i>
                                                                            <ins id="total_comment_{{ $item->id }}">{{ $item->total_comment ?? 0 }}</ins>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </figure>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="loadMore">
                            <button id="loadMoreBtn" class="btn-view btn-load-more">Load More</button>
                        </div>
                        {{-- <button id="loadMoreBtn" class="btn-load-more">Load More</button> --}}
                    </div><!-- centerl meta -->

                    <div class="col-lg-3">
                        <aside class="sidebar static right">
                            @if ($user)
                            <div class="widget">
                                <h4 class="widget-title">Thông tin cá nhân</h4>
                                <div class="your-page">
                                    <figure>
                                        <a href="{{ route('get.profile.detail', $user->id) }}" title=""><img style="width: 50px;height: 50px" src="{{ pare_url_file($user->avatar) }}" alt=""></a>
                                    </figure>
                                    <div class="page-meta">
                                        <a href="{{ route('get.profile.detail', $user->id) }}" title="" class="underline">{{ $user->name }}</a>
                                    </div>
                                    <div class="page-likes">
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane active fade show " id="link1" >
                                                <span><i class="ti-heart"></i>{{ count($userFollow ?? []) }} follow</span>
                                                @if (count($userFollow ?? []) > 0)
                                                    <div class="users-thumb-list">
                                                        @foreach($userFollow ?? [] as $item)
                                                            <a href="{{ route('get.profile.detail', $item->user_id) }}" title="Anderw" data-toggle="tooltip">
                                                                <img src="{{ pare_url_file($item->userFollow->avatar ?? '') }}" style="width: 32px;height: 32px" alt="">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- page like widget -->
                            @endif
                        </aside>
                    </div><!-- sidebar -->
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function toggleClass(element) {
    element.classList.toggle('active');
  }

</script>

@include('frontend.home.modal_show_article_detail');
@stop



    
