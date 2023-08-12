@extends('frontend.layouts.master')
@section('title_page','Thông tin tài khoản')
@section('content')
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">

                        <!-- user profile banner  -->
                        <div style="margin-left: 13%" class="col-lg-9">
                            <div class="central-meta article-list">
                                <div class="about">
                                    <div class="d-flex flex-row mt-2">
                                        @include('frontend.account.include._inc_sidebar')
                                        <div class="tab-content">

                                            <!-- messages -->
                                            <div class="tab-pane fade active show" id="weather" role="tabpanel">
                                                <div class="set-title">
                                                    <h5>Hi {{ $user->name }}</h5>
                                                    <form method="post" class="c-form" enctype="multipart/form-data">
                                                        @csrf
                                                        <div style="margin-bottom: 10px">
                                                            <label>Mật khẩu cũ</label>
                                                            <input type="password" placeholder="********" name="password_old" value="{{ old('password_old') }}">
                                                            @error('password_old')
                                                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password_old') }}</small>
                                                            @enderror
                                                        </div>
                                                        <div style="margin-bottom: 10px">
                                                            <label>Mật khẩu mới</label>
                                                            <input type="password" placeholder="********" name="password" value="{{ old('password') }}">
                                                            @error('password')
                                                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                                                            @enderror
                                                        </div>
                                                        <div style="margin-bottom: 10px">
                                                            <label>Xác nhận mật khẩu</label>
                                                            <input type="password"  placeholder="********" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                                            @error('password_confirmation')
                                                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
                                                            @enderror
                                                        </div>
                                                        <div>
                                                            <button type="submit" data-ripple="">Lưu thông tin</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- centerl meta -->
                        {{-- <div class="col-lg-3">
                            <aside class="sidebar static">
                                <div class="widget">
                                    <h4 class="widget-title">Your page</h4>
                                    <div class="your-page">
                                        <div class="page-likes">
                                            <ul class="nav nav-tabs likes-btn">
                                                <li class="nav-item"><a data-toggle="tab" href="#link1" class="active">likes</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#link2" class="">views</a></li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div id="link1" class="tab-pane active fade show">
                                                    <span><i class="ti-heart"></i>884</span>
                                                    <a title="weekly-likes" href="#">35 new likes this week</a>

                                                </div>
                                                <div id="link2" class="tab-pane fade">
                                                    <span><i class="ti-eye"></i>445</span>
                                                    <a title="weekly-likes" href="#">440 new views this week</a>
                                                </div>
                                            </div>
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
@stop
