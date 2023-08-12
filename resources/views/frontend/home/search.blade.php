@extends('frontend.layouts.master')
@section('title_page','Pet')
@section('content')
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <!-- sidebar -->
                        <div class="col-lg-12 d-flex">
                            <h5> Danh sách PET theo kết quả tìm kiếm</h5>
                        </div>
                        <!-- user profile banner  -->
                        <div class="col-lg-12">
                            <div class="row">
                                @if (count($pets) == 0)
                                    <h5 style="color:brown; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Không có pet nào được tìm thấy.</h5>
                                @endif
                                @foreach ($pets as $item)
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="friend-box">
                                            <div class="frnd-meta">
                                                <a href="{{ route('get.pet.detail', $item->id) }}">
                                                    <img style="margin-top: 0; margin-top: 0;
                                        width: 200px;
                                        height: 200px;
                                        margin-top: 20px;
                                        border-radius: 50%;
                                        object-fit: cover;" src="{{ pare_url_file($item->avatar) }}" alt="">
                                                    <ul class="frnd-info" style="margin-bottom: 0">
                                                        <li><span>Name:</span> {{ $item->name }}</li>
                                                    </ul>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex">
                            <h5> Danh sách thành viên theo kết quả tìm kiếm</h5>
                        </div>
                        <!-- user profile banner  -->
                        <div class="col-lg-12">
                            <div class="row">
                                @if (count($users) == 0)
                                    <h5 style="color:brown; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Không có thành viên nào được tìm thấy.</h5>
                                @endif
                                @foreach ($users as $item)
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="friend-box">
                                            <div class="frnd-meta">
                                                <a href="{{ route('get.profile.detail', $item->id) }}">
                                                    <img style="margin-top: 0; margin-top: 0;
                                            width: 200px;
                                            height: 200px;
                                            margin-top: 20px;
                                            border-radius: 50%;
                                            object-fit: cover;" src="{{ pare_url_file($item->avatar) }}" alt="">
                                                    <ul class="frnd-info" style="margin-bottom: 0">
                                                        <li><span>Name:</span> {{ $item->name }}</li>
                                                    </ul>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
