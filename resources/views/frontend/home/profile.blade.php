@extends('frontend.layouts.master')
@section('title_page','Thông tin tài khoản')
@section('content')
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">

                        <!-- user profile banner  -->
                        <div style="{{ ($user->id === Auth::user()->id) ? 'margin-left: 13%;' : '' }} " class="col-lg-9 ">  <!-- order-1  -->
                            <div class="central-meta">
                                <div class="about">
                                    <div class="d-flex flex-row mt-2">
                                        <div class="tab-content">

                                            <!-- messages -->
                                            <div class="tab-pane fade active show" id="weather" role="tabpanel">
                                                <div class="set-title">
                                                    <h5>Hi {{ $user->name }}</h5>
                                                    <span>Thông tin tài khoản</span>
                                                    <form method="post" class="c-form">
                                                        @csrf
                                                        <div style="margin-bottom: 10px">
                                                            <label>Họ tên</label>
                                                            <input disabled type="text" placeholder="Jack Carter" name="name" value="{{ $user->name}}">
                                                        </div>

                                                        <div style="margin-bottom: 10px">
                                                            <label>Email </label>
                                                            <input disabled type="text" placeholder="abc@pitnikmail.com" name="email" value="{{ $user->email}}">
                                                        </div>

                                                        <div style="margin-bottom: 10px">
                                                            <label>Phone </label>
                                                            <input disabled type="number" placeholder="abc@pitnikmail.com" name="phone" value="{{ $user->phone}}">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="central-meta">
                                    <span class="create-post">Pet .... <a href="#" title="">See All</a></span>
                                    <div class="story-postbox">
                                        <div class="row">
                                            @foreach($pets ?? [] as $item)
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="">
                                                        <a href="{{ route('get.pet.detail', $item->id) }}">
                                                            <img style="width: 120px;
                                                                        height: 120px;
                                                                        display: block;
                                                                        border-radius: 50%;
                                                                        object-fit: cover;" src="{{ pare_url_file($item->avatar) }}" alt="">
                                                                                                                    </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="central-meta">
                                    <span class="create-post">Bài viết</span>
                                    <div id="article-profile" class="article-list articleDetailContainer row merged20 remove-ext">
                                        @foreach($articles ?? [] as $item)
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <div class="tube-post">
                                                    <figure>
                                                        {{-- <a href="{{ route('get.article.detail', $item->id) }}">
                                                            <img style="height: 190px;object-fit: cover" src="{{ pare_url_file($item->avatar) }}" alt="">
                                                        </a>
                                                        @if ($item->is_video)
                                                            <div class="save-post" title="Watch Later"><i class="fa fa-clock-o"></i></div>
                                                        @endif --}}

                                                        <a data-id="{{ $item->id }}" class="view-detail-btn" title="">
                                                            @if ($item->video)
                                                                <video class="video" id="{{ $item->id }}" data-id="{{ $item->id }}" width="100%" height="183" controls>
                                                                    <source src="{{ pare_url_file($item->video) }}" type="video/mp4">
                                                                </video>
                                                            @else
                                                                    <img src="{{ pare_url_file($item->avatar) }}" style="height: 190px; object-fit: cover" alt="">
                                                            @endif
                                                        </a>

                                                        <em>Like: <span id="total_like_{{ $item->id }}">{{ $item->total_like }}</span></em>
                                                    </figure>
                                                    <div class="tube-title">
                                                        <h6><a data-id="{{ $item->id }}" class="view-detail-btn" title="{{ $item->name }}">{{ $item->name }}</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                            </div>
                            <div class="loadMore">
                                <button id="loadMoreBtn" class="btn-view btn-load-more justify-content-center">Load More</button>
                            </div>
                        </div>
                        <!-- centerl meta -->
                        @php
                            if (Auth::user()->id !== $user->id) {
                                $check = 1; // 
                            }else{
                                $check = 0;
                            }
                        @endphp
                      
                        <?php if ($check == 1): ?>
                            <div class="col-lg-3">
                                <aside class="sidebar static">
                                    <div class="widget">
                                        <h4 class="widget-title">Follow {{ $user->name }}</h4>
                                        <div class="your-page">
                                            <div class="page-likes">
                                                <ul class="nav nav-tabs likes-btn">
                                                    <li class="nav-item"><a style="{{ ($checkLike ?? '') ? 'font-weight: bold;background: #fa6342' : 'color:black; border: 1px solid #fa6342' }}" href="{{ route('user.follow', $user->id) }}" >Follow</a></li>
                                                    <li class="nav-item"><a href="{{ route('user.un_follow', $user->id) }}" class="">Un Follow</a></li>
                                                </ul>
                                            </div>
                                            <div class="text-center">{{ $user->name }} có {{ $user->total_follow }} người theo dõi</div>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        <?php endif; ?>

                        {{-- <div class="col-lg-3">
                            <aside class="sidebar static">
                                <div class="widget">
                                    <h4 class="widget-title">Follow {{ $user->name }}</h4>
                                    <div class="your-page">
                                        <div class="page-likes">
                                            <ul class="nav nav-tabs likes-btn">
                                                <li class="nav-item"><a href="{{ route('user.follow', $user->id) }}" class="{{ $check ? 'active' : '' }}">Follow</a></li>
                                                <li class="nav-item"><a href="{{ route('user.un_follow', $user->id) }}" class="">Un Follow</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div> --}}
                        <!-- sidebar -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.home.modal_show_article_detail');
@stop
