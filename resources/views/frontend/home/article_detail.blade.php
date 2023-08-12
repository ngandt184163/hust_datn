@extends('frontend.layouts.master')
@section('title_page',$article->name)
@section('content')
    {{-- <section> --}}
        <div class="gap gray-bg">
            <div id="articleDetailContainer" class="container">
                <div class="row" id="page-contents">
                    <div class="offset-lg-1 col-lg-10">
                        <div class="typography articleDetailContainer">
                            <div style="width: 70%; margin-left: 12%"  class="central-meta">
                                <span class="create-post">{{ $article->name }}
                                    <a style="font-size: 15px" href="#"><span>Có </span><span id="likeCount">{{ $article->total_like }}</span> <span>yêu thích</span></a>
                                    <a style="font-size: 15px;color: #212121" href="{{ $current_page }}"> Quay lại / </a>
                                </span>
                                @if ($article->pet_id != 0)
                                    <div style="color: #fa6243; margin-bottom: 10px"><a href="{{ route('get.pet.detail', $article->pet_id) }}">Đến thăm Pet nào.</a></div>
                                @endif
                                <div style="margin-bottom: 10px;">
                                    <a data-article-id="{{ $article->id }}" class="like-article a_like like_in" style="{{ ($checkLike ?? '') ? 'font-weight: bold;background: #fa6342' : 'color:black; border: 1px solid #fa6342' }}"  href="#">Like</a>
                                    {{-- <a style="{{ ($checkDislike ?? '') ? 'font-weight: bold;color: #fa6342' : '' }} "  href="{{ route('get.article.detail.dislike', $article->id) }}">Dislike</a> --}}
                                    <a class="a_like" style="background: blue" href="https://www.facebook.com/sharer/sharer.php?u={{  Request::url() }}" target="_blank" rel="noopener">
                                        Chia sẻ Facebook
                                    </a>
                                </div>
                                @if ($article->video)
                                    <video width="100%" height="240" controls>
                                        <source src="{{ pare_url_file($article->video) }}" type="video/mp4">
{{--                                        <source src="movie.ogg" type="video/ogg">--}}
                                    </video>
                                @else
                                    {{-- <a href="" style="margin-bottom: 10px;display: block">
                                        <img src="{{ pare_url_file($article->avatar) }}" style="width: 100%;height: auto" alt="">
                                    </a> --}}
                                @endif
                                @if ($article->avatar)
                                    <a href="" style="margin-bottom: 10px;display: block">
                                        <img src="{{ pare_url_file($article->avatar) }}" style="width: 100%;height: auto" alt="">
                                    </a>
                                @endif
                                {!! $article->description !!}
                                {!! $article->content !!}
                            </div>
                        </div>
                        <div class="central-meta item articleDetailContainer" style="display: inline-block; width: 70%; margin-left: 12%">
                            <div class="user-post">
                                <div class="friend-info">
                                    <div class="coment-area" style="display: block;">
                                        <ul id="div_comment" class="we-comet">
                                            <div id="commentList">
                                                @foreach($comments ?? [] as $item)
                                                    <li>
                                                        <div class="comet-avatar">
                                                            <img style="    width: 35px;height: 35px;border-radius: 50%;" src="{{ pare_url_file($item->user->avatar ?? "") }}" alt="">
                                                        </div>
                                                        <div class="we-comment">
                                                            <h5> <a href="{{ route('get.profile.detail', $item->user_id) }}" title="">{{ $item->user->name ?? "" }}</a></h5>
                                                            <br>
                                                            <p>{{ $item->created_at }} : {{ $item->content }}</p>
                                                        </div>

                                                    </li>
                                                @endforeach
                                            </div>
                                            <li class="post-comment">
                                                <div class="post-box">
                                                    <form class="comment-form" data-article-id="{{ $article->id }}" method="post" >
                                                        @csrf
                                                        <textarea id="content" name="comment" placeholder="Post your comment"></textarea>
                                                        {{-- @error('comment') --}}
                                                            <small id="emailHelp" class="form-text text-danger"></small>
                                                        {{-- @enderror --}}
                                                        <input type="hidden" name="article" value="{{ $article->id }}">
                                                        <button id="commentBtn" type="submit">Gủi bình luận</button>
                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    {{-- </section> --}}
@stop


