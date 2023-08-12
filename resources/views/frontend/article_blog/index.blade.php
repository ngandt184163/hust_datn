@extends('frontend.layouts.master')
@section('title_page','Bài viết')
@section('content')
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-12">
                            <div class="central-meta">
                                <span class="create-post">Quản lý bài viết blog <a href="{{ route('get_user.article_blog.create') }}">Thêm mới</a></span>
                                <div id="article-blog" class="article-list articleDetailContainer row merged20 remove-ext">
                                    @foreach($articles ?? [] as $item)
                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                            <div class="tube-post">
                                                <figure>
                                                    {{-- <img style="height: 190px;object-fit: cover" src="{{ pare_url_file($item->avatar) }}" alt="">
                                                    @if ($item->is_video)
                                                        <div class="save-post" title="Watch Later"><i class="fa fa-clock-o"></i></div>
                                                    @endif --}}

                                                    <a data-id="{{ $item->id }}" class="view-detail-btn" title="">
                                                        @if ($item->video)
                                                            <video class="video" id="{{ $item->id }}" data-id="{{ $item->id }}" width="100%" height="190" controls>
                                                                <source src="{{ pare_url_file($item->video) }}" type="video/mp4">
                                                            </video>
                                                        @else
                                                                <img src="{{ pare_url_file($item->avatar) }}" style="height: 190px; object-fit: cover" alt="">
                                                        @endif
                                                    </a>

                                                    <em>Like: <span id="total_like_{{ $item->id }}">{{ $item->total_like }}</span></em>
                                                    <div class="more">
                                                        <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                            <ul>
                                                                <li class="">
                                                                    <a href="{{ route('get_user.article_blog.update', $item->id) }}">Sửa</a>
                                                                </li>
                                                                <li class="">
                                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{ route('get_user.article_blog.delete', $item->id) }}">Xoá</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </figure>
                                                <div class="tube-title">
                                                    <h6><a data-id="{{ $item->id }}" class="view-detail-btn" title="">{{ $item->name }}</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="loadMore">
                                <button id="loadMoreBtn" class="btn-view btn-load-more">Load More</button>
                            </div>
                        </div><!-- centerl meta -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.home.modal_show_article_detail');
@stop
