@extends('layouts.master')

@section('title')
    <title>Beranda - Ensiklomedia</title>
@endsection

@section('content')
    <div id="all-output" class="col-md-10">
        @foreach ($cat as $k => $v)
        	<h1 class="new-video-title"><i class="fa fa-th-large"></i> {{$v->category}}</h1>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="video-item">
                        <div class="thumb">
                        	<div class="hover-efect"></div>
                            <small class="time">10:53</small>
                            <a href="{{route('watch')}}"><img src="{{ asset('assets/demo_img/v1.png')}}" alt=""></a>
                        </div>
                        <div class="video-info">
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                            <span class="views"><i class="fa fa-eye"></i>2.8M views </span>
                            <span class="date"><i class="fa fa-clock-o"></i>5 months ago </span>
                        </div>
                    </div>
                </div>
                <!-- // video-item -->

                <!-- video-item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="video-item">
                        <div class="thumb">
                        	<div class="hover-efect"></div>
                            <small class="time">10:53</small>
                            <a href="#"><img src="{{ asset('assets/demo_img/v2.png')}}" alt=""></a>
                        </div>
                        <div class="video-info">
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                            <span class="views"><i class="fa fa-eye"></i>2.8M views </span>
                            <span class="date"><i class="fa fa-clock-o"></i>5 months ago </span>
                        </div>
                    </div>
                </div>
                <!-- // video-item -->


                <!-- video-item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="video-item">
                        <div class="thumb">
                        	<div class="hover-efect"></div>
                            <small class="time">10:53</small>
                            <a href="#"><img src="{{ asset('assets/demo_img/v3.png')}}" alt=""></a>
                        </div>
                        <div class="video-info">
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                            <span class="views"><i class="fa fa-eye"></i>2.8M views </span>
                            <span class="date"><i class="fa fa-clock-o"></i>5 months ago </span>
                        </div>
                    </div>
                </div>
                <!-- // video-item -->


                <!-- video-item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="video-item">
                        <div class="thumb">
                        	<div class="hover-efect"></div>
                            <small class="time">10:53</small>
                            <a href="#"><img src="{{ asset('assets/demo_img/v4.png')}}" alt=""></a>
                        </div>
                        <div class="video-info">
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                            <span class="views"><i class="fa fa-eye"></i>2.8M views </span>
                            <span class="date"><i class="fa fa-clock-o"></i>5 months ago </span>
                        </div>
                    </div>
                </div>
                <!-- // video-item -->

            </div><!-- // row -->
        @endforeach


		</div>
@endsection