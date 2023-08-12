@extends('frontend.layouts.master')
@section('title_page',$articleDetail->name)
@section('content')
    <section>
        <div class="gap2 gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row merged20" id="page-contents">
                            <div class="col-lg-8 offset-2">
                                <div class="central-meta item">
                                    <div class="user-post">
                                        <div class="friend-info">
                                            <figure>
                                                <img style="width: 40px;height: 40px;border-radius: 50%;object-fit: cover" src="{{ pare_url_file($articleDetail->user->avatar ?? "") }}" alt="">
                                            </figure>
                                            <div class="friend-name">

                                                <ins><a href="{{ route('get.profile.detail', $articleDetail->user_id) }}" title="{{ $articleDetail->user->name ?? "" }}">Hi  {{ $articleDetail->user->name ?? "" }}</a></ins>
                                                <span><i class="fa fa-globe"></i> published: {{ $articleDetail->created_at }} </span>
                                            </div>

                                            <div class="post-meta">
                                                <figure>
                                                    {{-- <img src="{{ pare_url_file($articleDetail->avatar) }}" alt=""> --}}
                                                    @if ($articleDetail->video)
                                                        <video width="100%" height="300px" controls>
                                                            <source src="{{ pare_url_file($articleDetail->video) }}" type="video/mp4">
                                                        </video>
                                                    @else
                                                            <img style="height=300px" src="{{ pare_url_file($articleDetail->avatar) }}" alt="">
                                                    @endif
                                                </figure>
                                                <div style="margin-top: 10px">{{ $articleDetail->description }}</div>
                                                <div class="description">
                                                    {!! $articleDetail->content !!}
                                                </div>
                                            </div>
                                            <span class="create-post">{{ $articleDetail->name }}
                                                <a style="font-size: 15px" href="#"><span>Có </span><span id="likeCount">{{ $articleDetail->total_like }}</span> <span>yêu thích</span></a>
                                                <a style="font-size: 15px;color: #212121" href="{{ $current_page }}"> Quay lại / </a>
                                            </span>
                                            <div style="margin-bottom: 10px;">
                                                <a data-article-id="{{ $articleDetail->id }}" class="like-article a_like like_in" style="{{ ($checkLike ?? '') ? 'font-weight: bold;background: #fa6342' : 'color:black; border: 1px solid #fa6342' }}"  href="#">Like</a>
                                                {{-- <a style="{{ ($checkDislike ?? '') ? 'font-weight: bold;color: #fa6342' : '' }} "  href="{{ route('get.article.detail.dislike', $article->id) }}">Dislike</a> --}}
                                                <a class="a_like" style="background: blue" href="https://www.facebook.com/sharer/sharer.php?u={{  Request::url() }}" target="_blank" rel="noopener">
                                                    Chia sẻ Facebook
                                                </a>
                                            </div>
                                            <div class="central-meta item" style="display: inline-block;">
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
                                                                        <form id="comment-form" data-article-id="{{ $articleDetail->id }}" method="post" >
                                                                            @csrf
                                                                            <textarea id="content" name="comment" placeholder="Post your comment"></textarea>
                                                                            <small id="emailHelp" class="form-text text-danger"></small>
                                                                            <input type="hidden" name="article" value="{{ $articleDetail->id }}">
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
                            </div><!-- centerl meta -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
