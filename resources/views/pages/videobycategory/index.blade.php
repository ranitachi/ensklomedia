@extends('layouts.master-admin')

@section('title')
    <title>Category - Ensiklomedia</title>
    <style>
        .share-in {
            margin-top: 0px !important;
        }

        .custom-size {
            height: 118px;
            width: 208px;
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
    @php
        $first_letter=substr($category_name,0,1);
    @endphp
        <!-- Category Cover Image -->
        <div id="category-cover-image" class="hidden-sm hidden-xs">
            <div class="image-in">
                <img src="{{ asset('assets/demo_img/category-img.jpg') }}" style="width:100%;height:150px;" alt="">
            </div>
            <h1 class="title"> <span data-letters="{{$first_letter}}"></span>&nbsp;{{ $category_name }}</h1>
            <ul class="category-info">
                {{-- <li>97,174,199 Total Subscribers </li>
                <li>255,525,456 Total Views</li> --}}
            </ul>
        </div>
        <!-- // Category Cover Image -->
        <div class="hidden-lg hidden-md" style="margin-top:10px;">&nbsp;</div>
        <!-- category -->
        <div id="category">
            <div class="row">
                <div class="col-md-2 hidden-sm hidden-xs">
                    <div class="share-in">
                        <h1 class="title">Mata Pelajaran</h1>
                        <ul class="social-link">
                          @if (count($mapel)!=0)
                              @foreach ($mapel as $item)
                                <li class="google-plus"><a href="#"> {{$item->title}} </a></li>  
                              @endforeach
                          @endif  
                            
                        </ul>
                        <br><br>
                        {{-- <h1 class="title">Topik Tantangan</h1>
                        <ul class="social-link">
                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i> 11200 </a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i> 514 </a></li>
                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i> 514 </a></li>
                            <li class="vimeo"><a href="#"><i class="fa fa-vimeo"></i> 155 </a></li>
                        </ul> --}}
                    </div>

                </div><!-- // col-md-2 -->

                <div class="col-md-10 col-xs-12 col-sm-12">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            
                            <div class="row">
                                    
                            @foreach ($videos->chunk(3) as $chunk)
                                    @foreach ($chunk as $video)
                                    @php
                                        $waktu=$video->created_at->diffForHumans();
                                        $wkt=text_translate($waktu,'en','id');
                                        
                                        $durasi='00:00';
                                        if($video->duration!='00:00:00')
                                            {
                                                if($video->duration!=-1)
                                                {
                                                    if(strtok($video->duration,':')=='00')
                                                    {
                                                        $durasi=substr($video->duration,3,5);
                                                    }
                                                    else
                                                        $durasi=$video->duration;
                                                }
                                                else if($video->duration==0)
                                                {
                                                    $durasi="00:00";
                                                }
                                                else {
                                                    $durasi="00:00";
                                                }
                                            }
                                            else {
                                                
                                                $durasi="00:00";
                                            }
                                    @endphp
                                        @if ($durasi!='00:00')
                                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 margin-left-right-2 col-custom">
                                                <div class="video-item">
                                                    <div class="thumb" style="background:url(assets/img/no-image-02.png);background-size:90% 100%;background-position:center;border:1px solid #ccc;"> 
                                                        <div class="hover-efect"></div>
                                                        <small class="time">{{$durasi}}</small>
                                                        @php

                                                            $cover = "http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/image/".$video->image_path;
                                                            if (File::exists(public_path().'/uploadfiles/image/'.$video->image_path)) {
                                                                $cover = url('uploadfiles/image/'.$video->image_path);
                                                            }
                                                            else
                                                            {
                                                                $cv='assets/img/no-image-02.png';
                                                                $cover=url($cv);
                                                            }
                                                        @endphp
                                                        <a href="{{ route('watch', $video->slug) }}" onclick="addhit('{{$video->id}}')"><img class="custom-size" src="{{ $cover }}" alt=""></a>
                                                    </div>
                                                    <div class="video-info">
                                                        <a href="{{ route('watch', $video->slug) }}" class="title">{{ ucwords(strtolower($video->title)) }}</a>
                                                        <a class="channel-name" href="#" onclick="addhit('{{$video->id}}')">{{ $category_name }}    </a>
                                                        <span class="views"><i class="fa fa-eye"></i>{{ $video->hit }} views </span>
                                                        <span class="date"><i class="fa fa-clock-o"></i>{{$wkt}} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div><!-- // row -->

                        </div>
                        
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