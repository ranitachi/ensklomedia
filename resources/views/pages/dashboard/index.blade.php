@extends('layouts.master')

@section('title')
    <title>Beranda - Ensiklomedia</title>
     <link href="{{asset('css/videojs.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div id="all-output" class="col-md-10">
        @foreach ($cat as $k => $v)
            <h1 class="new-video-title"><i class="fa fa-th-large"></i> {{$v->category}}</h1>
            <div class="row">
            @php
            if(isset($video[$v->id]))
            {
                $fourdata = array_slice($video[$v->id], 0, 4);
                //$no=1;
                foreach($fourdata as $ixk => $vik)
                {
                    $cover="http://ensiklomedia.kemdikbud.go.id/uploads/images/".$vik->image;
                    if(File::exists($vik->image))
                    {
                        $cv = 'uploadfiles/image/'.$video->image;
                        $cover = url($cv);
                        $vv='uploadfiles/video/'.$video->videofile;
                        $vid=url($vv);
                    }
                    else
                    {   
                        //$handle=fopen($cover,'r');
                        $vid="http://ensiklomedia.kemdikbud.go.id/uploads/videos/".$vik->videofile;
                        $cover=$cover;
                        //$fileExists = checkExternalFile($cover);
                        /*if($fileExists==200)
                        {
                            $cover=$cover;
                        }
                        else
                        {
                            $cv='assets/img/no-image-02.png';
                            $cover=url($cv);
                        }*/
                    }
                    $mime = "video/mp4";
                    
                    /*$ffmpeg = FFMpeg\FFMpeg::create(array(
                        'ffmpeg.binaries'  => '/usr/local/Cellar/ffmpeg/3.4.2/bin/ffmpeg',
                        'ffprobe.binaries' => '/usr/local/Cellar/ffmpeg/3.4.2/bin/ffprobe' ,
                        'timeout'          => 3600, // The timeout for the underlying process
                        'ffmpeg.threads'   => 12,
                    ),$logger);*/
                    //$video = $ffmpeg->open($vid);
                    //$media = FFMpeg::open($vid);
                    //$getID3 = new \getID3;
                    //$duration= getDuration($vid);
                    
            @endphp
                  <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="video-item">
                        <div class="thumb" style="height:150px;background:url(assets/img/no-image-02.png);background-size:90% 100%;background-position:center">
                        	<div class="hover-efect"></div>
                            <small class="time">10:53</small>
                            <a href="{{route('watch', $vik->slug)}}"><img src="{{ $cover}}" alt="" style="height:150px;width:100%"></a>
                        </div>
                        <!--<a href="{{route('watch', $vik->slug)}}">
                            <div class="thumb" id="thumb" style="height:150px;background:url(assets/img/no-image-02.png);background-size:100% 100%;">
                                <video id="example_video_{{$vik->id}}" class="video-js vjs-default-skin vjs-big-play-centered"
                                    controls preload="auto" height="180">
                                    <source src="{{$vid}}" type="{{$mime}}" />
                                </video>
                            </div>
                        </a>-->
                        <div class="video-info">
                            <a href="{{route('watch', $vik->slug)}}" class="title">{{$vik->title}}</a>
                            <a class="channel-name" href="#">{{$v->category}}<span>
                            <i class="fa fa-check-circle"></i></span></a>
                            <span class="views"><i class="fa fa-eye"></i>{{$vik->hit}} views </span>
                            <span class="date"><i class="fa fa-clock-o"></i>5 months ago </span>
                        </div>
                    </div>
                </div>  
            @php
                }
            }
            @endphp
            </div>
        @endforeach


		</div>
@endsection
@section('footscript')
    <script src="{{asset('js/videojs.js')}}"></script>
    <script>
        //var lebar=document.getElementById("thumb").offsetWidth;
        //alert(width);
        /*$('video.video-js').each(function(a){
            var id=$(this).attr('id');
            //$('div#'+id).css({'width': width+'px !important'});
            videojs(document.getElementById(id), {
                    width: lebar, 
                    height: 150
                }, function() {
                    this.bigPlayButton.hide();
            });
            // This is functionally the same as the previous example.
        });*/
    </script>
    <style>
        div#example_video_1
        {
            /*width:100% !important;*/
        }
    </style>
@endsection