@extends('frontend.layouts.master')
@section('title_page',$pet->name)
@section('content')
    <section>
        <div class="gap gray-bg">
            <div class="container">
                <div class="row" id="page-contents">
                    <div class="offset-lg-1 col-lg-10">
                        <div class="typography">
                            <div class="central-meta">
                                <span class="create-post">Chi tiết thú cưng {{ $pet->name }}
                                    <a style="font-size: 15px" href="javascript:;void(0)"><span>Có </span><span id="likeCountPet">{{ $pet->total_like }}</span> <span>yêu thích</span></a>
                                    <a style="font-size: 15px;color: #212121" href="/"> Quay lại / </a>
                                </span>
                                <div style="margin-bottom: 10px;">
                                    {{-- <a style="{{ $checkLike ? 'font-weight: bold' : '' }} "  class="main-btn create-pst" href="{{ route('get.pet.detail.like', $pet->id) }}">Like</a> --}}
                                    <a data-pet-id="{{ $pet->id }}" class="like-pet a_like" style="{{ ($checkLike ?? '') ? 'font-weight: bold;background: #fa6342' : 'color:black; border: 1px solid #fa6342' }}"  href="{{ route('get.pet.detail.like', $pet->id) }}">Like</a>
                                    {{-- <a style="{{ $checkDislike ? 'font-weight: bold' : '' }} "  class="main-btn create-pst" href="{{ route('get.pet.detail.dislike', $pet->id) }}">Dislike</a> --}}
                                </div>
                                <p style="margin-bottom: 5px">Tuổi : <b>{{ $pet->age }}</b></p>
                                <p style="margin-bottom: 5px">Giới tính : <b>{{ $pet->sex }}</b></p>
                                <p style="margin-bottom: 5px">Loại : <b>{{ $pet->category->name ?? "" }}</b></p>
                                <p style="margin-bottom: 5px">Chủ nhân : <a href="{{ route('get.profile.detail', ['id' => $pet->user_id]) }}"><b style="color: #fa6342">{{ $pet->user->name ?? "" }}</b></a></p>
                                <a href="" style="margin-bottom: 10px;display: block">
                                    <img src="{{ pare_url_file($pet->avatar) }}" style="width: 100%;height: auto" alt="">
                                </a>
                                {!! $pet->description !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row merged20">
                    <div class="offset-lg-1 col-lg-10">
                        <div id="article-pet" class="article-list articleDetailContainer row">
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
                                                        {{-- <a title="" href="{{ route('get.article.detail', $item->id) }}">
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
                                                    </figure>
                                                    <div class="description">
                                                        <a data-ripple="" class="learnmore view-detail-btn" data-id="{{ $item->id }}">Chi tiết</a>
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
                    </div>
                </div>
                <div class="loadMore">
                    <button id="loadMoreBtn" class="btn-view btn-load-more">Load More</button>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.home.modal_show_article_detail');
@stop
