@extends('layouts.master-admin')

@section('title')
    <title>Category - Ensiklomedia</title>
    <style>
        .share-in {
            margin-top: 0px !important;
        }

        .custom-size {
            height: 150px;
            width: 100%;
        }

        .thumb {
            height: 150px;
            background: url({{ asset('assets/img/no-image-02.png') }});
            background-size: 90% 100%;
            background-position: center;
        }
    </style>
@endsection

@section('content')
    @include('includes.sidebar-admin')  
    
    <div id="all-output" class="col-md-10">
        <!-- Category Cover Image -->
        <div id="category-cover-image">
            <div class="image-in">
            <img src="{{ asset('assets/demo_img/category-img.jpg') }}" alt="">
            </div>
            <h1 class="title"><i class="fa fa-music"></i> Music</h1>
            <ul class="category-info">
                <li>97,174,199 subscribers </li>
                <li>255,525,456 Views</li>
                <li>45,23,65 Channel No</li>
                <li class="subscribe"><a href="#">Subscribe</a></li>
            </ul>
        </div>
        <!-- // Category Cover Image -->

        <!-- category -->
        <div id="category">
            <div class="row">
                <div class="col-md-2">
                    <div class="share-in">
                        <h1 class="title">Share in</h1>
                        <ul class="social-link">
                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i> 11200 </a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i> 514 </a></li>
                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i> 514 </a></li>
                            <li class="vimeo"><a href="#"><i class="fa fa-vimeo"></i> 155 </a></li>
                        </ul>
                    </div>

                    <div class="advertising-block">
                        <h1 class="title">Advertising</h1>
                        <div class="advertising-code">
                            <a href="#"><img src="{{ asset('assets/demo_img/adv.jpg') }}" alt=""></a>
                        </div>
                    </div>

                </div><!-- // col-md-2 -->

                <div class="col-md-10">

                    <h1 class="new-video-title"><i class="fa fa-bolt"></i> Trending</h1>

                    @foreach ($videos->chunk(3) as $chunk)
                        <div class="row">
                            @foreach ($chunk as $video)
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="video-item">
                                        <div class="thumb">
                                            <div class="hover-efect"></div>
                                            <small class="time">10:53</small>
                                            @php
                                                $cover = "http://ensiklomedia.kemdikbud.go.id/uploads/images/".$video->image_path;
                                                if (File::exists($video->image_path)) {
                                                    $cover = url('uploadfiles/image/'.$video->image_path);
                                                }
                                            @endphp
                                            <a href="#"><img class="custom-size" src="{{ $cover }}" alt=""></a>
                                        </div>
                                        <div class="video-info">
                                            <a href="#" class="title">{{ $video->title }}</a>
                                            <a class="channel-name" href="#">{{ isset($video->user->profile->name) && !is_null($video->user->profile->name) ? $video->user->profile->name : 'No Name' }}<span>
                                            <i class="fa fa-check-circle"></i></span></a>
                                            <span class="views"><i class="fa fa-eye"></i>{{ $video->hit }} views </span>
                                            <span class="date"><i class="fa fa-clock-o"></i>5 months ago </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div><!-- // row -->
                    @endforeach


                    <!-- Loading More Videos -->
                    <div id="loading-more">
                        <i class="fa fa-refresh faa-spin animated"></i> <span>Loading more</span>
                    </div>
                    <!-- // Loading More Videos -->

                </div>
            </div><!-- // row -->
        </div>
        <!-- // category -->

    </div>
@endsection

@section('footscript')
    
@endsection