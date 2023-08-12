@extends('frontend.layouts.master')
@section('title_page','Pet')
@section('content')
<div class="gap2 gray-bg">
    <div class="container article-list">
        <div class="row">
            <div class="col-lg-12">
                <div class="row merged20" id="page-contents">
                <!-- sidebar -->
                    <div class="col-lg-12 d-flex">
                        <h5 style="display: flex;justify-content: space-between;width: 100%"> <span>Danh sách PET</span> <a hidden href="{{ route('get_user.pet.create')}}" style="background: #fa6342 none repeat scroll 0 0;
                            border: medium none;
                            border-radius: 5px;
                            color: #fff;
                            text-align: center;
                            font-weight: 500;
                            margin-top: 11px;
                            padding: 5px;
                            width: 150px;
                            transition: all 0.2s linear 0s;
                            margin-right: 40px "
                            >Thêm mới</a>
                            <a style="background-color: #fa6243" href="#" class="btn btn-success btn-add" data-target="#modal-add" data-toggle="modal">Thêm thú cưng</a>
                        </h5>
                    </div>
                    <!-- user profile banner  -->
                    <div class="col-lg-12">
                        <div id="pet-list" class="row">
                        @foreach ($pets ?? [] as $item)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="friend-box">
                                    <div class="frnd-meta">
                                        <a href="{{ route('get.pet.detail', $item->id) }}">
                                            <img  style="margin-top: 0; margin-top: 0;
                                            width: 200px;
                                            height: 200px;
                                            margin-top: 20px;
                                            border-radius: 50%;
                                            object-fit: cover;" src="{{ pare_url_file($item->avatar) }}" alt="">
                                        </a>
                                        <ul class="frnd-info" style="margin-bottom: 0">
                                            <li><span>Name:</span> <a style="color: #fa6243" href="{{ route('get.pet.detail', $item->id) }}">{{ $item->name }}</a></li>
                                            <li><span>Tuổi:</span> {{$item->age}}</li>
                                            <li><span>Loại:</span> {{$item->category->name ?? ""}}</li>
                                        </ul>
                                        <p style="display:flex;justify-content: space-between;">
                                            <a href="{{ route('get_user.pet.update', $item->id) }}" title="">Sửa</a>
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{ route('get_user.pet.delete', $item->id) }}" title="">Xoá</a>
                                        </p>

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

@include('frontend.pet.add_modal')
@stop
