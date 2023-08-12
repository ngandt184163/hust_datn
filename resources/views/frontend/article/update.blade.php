@extends('frontend.layouts.master')
@section('title_page','Update')
@section('content')
    <style>
        .customer-form input, .customer-form select, .customer-form textarea {
            border: 1px solid ;
            padding: 10px;
            min-height: 40px;
        }
    </style>
    <div class="gap2 gray-bg" style="min-height: 60vh">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20 central-meta customer-form" id="page-contents">
                        <!-- sidebar -->
                        <div class="col-lg-12 d-flex">
                            <span class="create-post">Cập nhật <a href="{{ route('get_user.article.index') }}">Trở về</a></span>
                        </div>
                        <!-- user profile banner  -->
                        <div class="col-lg-12">
                            @include('frontend.article.form')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
