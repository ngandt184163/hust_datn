@extends('frontend.layouts.master')
@section('title_page','Story')
@section('content')
    <section>
        <div class="gap gray-bg">
            <div class="container">
                <div class="row" id="page-contents">
                    <div class="offset-lg-1 col-lg-10">
                        <div class="typography">
                            <div class="central-meta">
                                <span class="create-post">Chi tiết story</span>
                                <div style="margin-bottom: 10px;">
                                    <a style="{{ $checkLike ? 'font-weight: bold;color: #fa6342' : '' }} "  href="{{ route('get.story.detail.like', $story->id) }}">Like</a>
                                    <a style="{{ $checkDislike ? 'font-weight: bold;color: #fa6342' : '' }} "  href="{{ route('get.story.detail.dislike', $story->id) }}">Dislike</a>
                                </div>
                                <a href="">
                                    <img src="{{ pare_url_file($story->avatar) }}" style="width: 100%;height: auto" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
