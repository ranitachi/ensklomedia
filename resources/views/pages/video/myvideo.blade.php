@extends('layouts.master-admin')

@section('title')
    <title>Video Saya - Ensiklomedia</title>
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
            background: url("{{ asset('assets/img/no-image-02.png') }}");
            background-size: 95% 100%;
            background-position: center;
        }
    </style>
@endsection
@section('content')
        <!-- Category Cover Image -->
        <div id="category-cover-image" class="hidden-sm hidden-xs">
            <div class="image-in">
                <img src="{{ asset('assets/demo_img/category-img.jpg') }}" alt="">
            </div>
            <h1 class="title"><i class="fa fa-music"></i> Kategori</h1>
            <ul class="category-info">
                <li>97,174,199 Total Subscribers </li>
                <li>255,525,456 Total Views</li>
            </ul>
        </div>
        <!-- // Category Cover Image -->
        <div class="hidden-lg hidden-md" style="margin-top:10px;">&nbsp;</div>
        <!-- category -->
        <div id="category">
            <div class="row">
                <div class="col-md-2 hidden-sm hidden-xs">
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

                <div class="col-md-10 col-xs-12 col-sm-12">
                    @php
                        // $first_letter=substr($category_name,0,1);
                        $first_letter='A';
                    @endphp
                    <div class="row">
                        <div class="col-lg-1-dash col-md-1-dash col-sm-1-dash">&nbsp;</div>
                        <div class="col-lg-10-dash col-md-10-dash col-sm-10-dash">
                            
                            <div class="row">
                                    <h1 class="new-video-title" style="padding-top:0px !important;padding-bottom:0px;"><span data-letters="{{$first_letter}}"> Kategori</span></h1>
                            @foreach ($videos->chunk(3) as $chunk)
                                    @foreach ($chunk as $video)
                                    @php
                                        $waktu=$video->created_at->diffForHumans();
                                        $wkt=text_translate($waktu,'en','id');
                                        // $wkt=$waktu;
                                    @endphp
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 padding-left-right-3">
                                            <div class="video-item">
                                                <div class="thumb" style="height:150px;background:url(assets/img/no-image-02.png);background-size:90% 100%;background-position:center;border:1px solid #ccc;">
                                                    <div class="hover-efect"></div>
                                                    <small class="time">10:53</small>
                                                    @php
                                                        $cover = "http://ensiklomedia.kemdikbud.go.id/uploads/images/".$video->image_path;
                                                        if (File::exists('uploadfiles/image/'.$video->image_path)) {
                                                            $cover = url('uploadfiles/image/'.$video->image_path);
                                                        }

                                                        if($video->approved_by==1)
                                                        {
                                                            $cover=url('assets/img/belum-dikaji.jpg');
                                                        }
                                                    @endphp
                                                    <a href="{{ route('watch', $video->slug) }}" onclick="addhit('{{$video->id}}')"><img class="custom-size" src="{{ $cover }}" alt="" style="height:150px;width:100%"></a>
                                                </div>
                                                <div class="video-info">
                                                    <a href="{{ route('watch', $video->slug) }}" class="title">{{ $video->title }}</a>
                                                    {!!$video->approved_by==0 ? '<i>Menunggu Persetujuan Admin</i>':''!!}
                                                    <a class="channel-name" href="#" onclick="addhit('{{$video->id}}')">{{ isset($video->user->profile->channel_name) && !is_null($video->user->profile->channel_name) ? $video->user->profile->channel_name : 'No Channel Name' }}<span>
                                                    <i class="fa fa-check-circle"></i></span></a>
                                                    <span class="views"><i class="fa fa-eye"></i>{{ $video->hit }} views </span>
                                                    <span class="date"><i class="fa fa-clock-o"></i>{{$wkt}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div><!-- // row -->

                        </div>
                        <div class="col-lg-1-dash col-md-1-dash col-sm-1-dash">&nbsp;</div>
                    <!-- Loading More Videos -->
                    {{--  <div id="loading-more">
                        <i class="fa fa-refresh faa-spin animated"></i> <span>Loading more</span>
                    </div>  --}}
                    <!-- // Loading More Videos -->

                </div>
            </div><!-- // row -->
        </div>
        <!-- // category -->

   
@endsection

@section('footscript')
    <script>
        function addhit(id)
        {
            $.ajax({
                url : APP_URL+'/video-add-hit/'+id,
                success : function(a){
                }
            });
        }
    </script>
@endsection