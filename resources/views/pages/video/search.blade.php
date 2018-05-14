@extends('layouts.master')

@section('title')
    <title>{{($id==-1 ? 'Lihat Video' : ucwords(strtolower($video->title)))}} - Ensiklomedia</title>
     <link href="{{asset('css/videojs.css')}}" rel="stylesheet">
     <link href="{{asset('css/videojs.endcard.css')}}" rel="stylesheet">
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

        .reply {
            cursor: pointer;
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s;
        }
        
        .fade-enter, .fade-leave-to {
            opacity: 0;
        }

        div#example_video_1
        {
            width:100% !important;
        }
    </style>
@endsection

@section('content')
        @if ($id==-1)
            <div class="row margin-m-100">
                <div class="col-lg-12 col-md-12 col-cm-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1">&nbsp;</div>
                    <div class="col-lg-10 col-md-10 col-sm-10">
                        <div class="row">
                            <h1 class="new-video-title" style="padding-top:0px !important;padding-bottom:0px;"><span data-letters="S"> Hasil Pencarian : {{count($video)}} video</h1>
                       @php
                        if(isset($video))
                        {
                            //$no=1;
                            // shuffle($video);

                            // $eightdata = array_slice($video, 0, 12);
                            foreach($video as $ixk => $vik)
                            {
                                $cover="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/image/".$vik->image_path;
                                if(File::exists($vik->image_path))
                                {
                                    $cv = 'uploadfiles/image/'.$video->image_path;
                                    $cover = url($cv);
                                    $vv='uploadfiles/video/'.$video->video_path;
                                    $vid=url($vv);
                                }
                                else
                                {   
                                    //$handle=fopen($cover,'r');
                                    $vid="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/video/".$vik->video_path;
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
                                $waktu=\Carbon\Carbon::parse($vik->created_at)->diffForHumans();
                                    $wkt=text_translate($waktu,'en','id');
                                $durasi='00:00';
                                    if($vik->duration!='00:00:00')
                                    {
                                        if($vik->duration!=-1)
                                        {
                                            if(strtok($vik->duration,':')=='00')
                                            {
                                                $durasi=substr($vik->duration,3,5);
                                            }
                                            else
                                                $durasi=$vik->duration;
                                        }
                                        else if($vik->duration==0)
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

                                    if(isset($vik->category->name))
                                        $kategori=$vik->category->name;
                                    else
                                        $kategori='';

                                    if(is_null($vik->approved_by))
                                    {
                                        $cv = 'assets/img/belum-dikaji.jpg';
                                        // $cover = url($cv);
                                        // $durasi='';
                                    }
                                
                        @endphp
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 margin-left-right-2 col-custom hidden-sm hidden-xs">
                                    <div class="video-item">
                                        <div class="thumb" style="background:url(assets/img/no-image-02.png);background-size:90% 100%;background-position:center;border:1px solid #ccc;">
                                            @if(is_null($vik->approved_by))
                                                <div class="hover-efect ribbon"><i class="fa fa-info-circle" style="color:white !important"></i>&nbsp;&nbsp;Belum Dikaji</div>
                                            @else
                                                <div class="hover-efect"></div>
                                            @endif
                                                <small class="time">{{$durasi}}</small>
                                            <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')"><img src="{{ $cover}}" alt="" style="height:118px;width:210px"></a>
                                        </div>
                                        
                                        <div class="video-info">
                                            <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')" class="title">{{(($vik->title))}}</a>
                                            <a class="channel-name" href="#">{{$kategori}}</a>
                                                <span class="views"><i class="fa fa-eye"></i>{{$vik->hit}} views </span>
                                                <span class="date"><i class="fa fa-clock-o"></i>{{trim($wkt)}}</span>
                                         </div>
                                    </div>
                                </div>  
                                
                                <div class="col-sm-6 col-xs-6 padding-left-right-3 hidden-lg hidden-md">
                                    <div class="video-item">
                                        <div class="thumb" style="background:url(assets/img/no-image-02.png);background-size:90% 100%;background-position:center;border:1px solid #ccc;">
                                            <div class="hover-efect"></div>
                                            @if($durasi!='')
                                                <small class="time">{{$durasi}}</small>
                                            @endif
                                            <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')"><img src="{{ $cover}}" alt="" style="width:100%"></a>
                                        </div>
                                        
                                        <div class="video-info">
                                            <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')" class="title">{{(($vik->title))}}</a>
                                            <a class="channel-name" href="#">{{$kategori}}</a>
                                            <span class="views"><i class="fa fa-eye"></i>{{$vik->hit}} views </span>
                                            <span class="date"><i class="fa fa-clock-o"></i>{{$wkt}}</span>
                                        </div>
                                    </div>
                                </div>  
                        @php
                            }
                        }
                        @endphp
                      
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1">&nbsp;</div>
                    
            </div>
        @else                
            <div class="row margin-m-100"></div>
            <div class="row hidden-lg hidden-md">
                <div class="col-xs-12 col-sm-12 no-padding-all">
                    {{--  <video id="example_video_mobile" class="video-js vjs-default-skin vjs-big-play-centered hidden-lg hidden-md" preload="auto" controls height="300" width="100%">
                        <source src="{{$vid}}" type="{{$mime}}" />
                    </video>  --}}
                    <video class="hidden-lg hidden-md" preload="" controls="" style="width:100%;height:auto;">
                        <source src="{{$vid}}"/>
                    </video>
                </div>
                
                <div class="col-xs-12 col-sm-12 no-padding-all" style="margin:0px !important">
                    <h1 class="video-title title-watch">{{($id==-1 ? 'Video Tidak Tersedia' : ucwords(strtolower($video->title)))}}</h1>
                    <div id="watch" style="padding:0px !important;margin:0px !important;">
                        <div class="chanel-item" style="margin-bottom:0px !important;">
                        		
                        		<div class="chanel-info" style="margin:0px !important;line-height:16px !important;">
                                    <a class="title" href="#">Deksripsi</a>
                                    <br>
                        			<span class="subscribers" style="text-transform:capitalize !important" style="padding-top:10px;">{{($id==-1 ? 'Deskripsi Tidak Tersedia' : $video->desc)}}</span>
                        		</div>
                        		
                        </div>

                        <div class="video-share" style="padding:8px !important;margin:0px !important">
                            <ul class="like">
                                <li><a class="like" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;{{($id==-1 ? 0 : $video->hit)}} views</i></a></li>
                            </ul>
                            <ul class="social_link">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a class="youtube" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a class="google" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a class="rss" href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                            </ul><!-- // Social -->
                        </div>
                    </div>
                        
                </div>
            </div>
            <div class="row">
            	<!-- Watch -->
                {{--  <div class="col-md-1 hidden-sm hidden-xs">&nbsp;</div>  --}}
                <div class="col-md-8 hidden-sm hidden-xs">
                	<div id="watch" style="">
                        @php
                            $cover="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/image/".$video->image_path;
                            if(File::exists(public_path().'/uploadfiles/image/'.$video->image_path))
                            {
                                $cv = 'uploadfiles/image/'.$video->image_path;
                                $cover = url($cv);
                            }
                        @endphp
                        <!-- Video Player -->
                        <div class="video-code">
                            <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
                            controls preload="auto" height="400" poster="{{$cover}}">
                            
                            <source src="{{$vid}}" type="{{$mime}}" />
                        </video>
                        <!--<iframe width="100%" height="415" src="https://www.youtube.com/embed/e452W2Kj-yg" frameborder="0" allowfullscreen></iframe>-->
                        </div><!-- // video-code -->
                        <h1 class="video-title title-watch">{{($id==-1 ? 'Video Tidak Tersedia' : ucwords(strtolower($video->title)))}}</h1>

                        <div class="video-share">
                        	<ul class="like">
                            	<li><a class="like" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;{{($id==-1 ? 0 : $video->hit)}} views</i></a></li>
                            </ul>
                        	<ul class="like pull-right">
                            	<li>
                                    <div >
                                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-clone"></i>&nbsp;Buat Saung Diskusi</a>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- // video-share -->
                        <!-- // Video Player -->


						<!-- Chanels Item -->
                        	<div class="chanel-item">
                        		
                        		<div class="chanel-info">
                        			<a class="title" href="#">Deksripsi</a>
                        			<span class="subscribers" style="text-transform:capitalize !important">{{($id==-1 ? 'Deksripsi Tidak Tersedia' : $video->desc)}}</span>
                        		</div>
                        		
                        	</div>
                        <!-- // Chanels Item -->


                        <!-- Comments -->
                        
                    </div>
                </div>

                <!-- Related Posts-->
                <div class="col-md-4 col-sm-12 col-xs-12">
                	<div id="related-posts" style="padding:0px !important;margin:20px 0px 0x 0px !important;">
                        @foreach ($relatedvideo as $related)
                            @php
                                $durasi='00:00';
                                if($related->duration!='00:00:00')
                                    {
                                        if($related->duration!=-1)
                                        {
                                            if(strtok($related->duration,':')=='00')
                                            {
                                                $durasi=substr($related->duration,3,5);
                                            }
                                            else
                                                $durasi=$related->duration;
                                        }
                                        else if($related->duration==0)
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
                            <!-- video item -->
                            <div class="related-video-item">
                                <div class="thumb">
                                    @if(is_null($related->approved_by))
                                    <div class="hover-efect ribbon"><i class="fa fa-info-circle" style="color:white !important"></i>&nbsp;&nbsp;Belum Dikaji</div>
                                    @else
                                        <div class="hover-efect"></div>
                                    @endif
                                    <small class="time">{{$durasi}}</small>
                                    @php
                                        $cover = "http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/image/".$related->image_path;
                                        if (File::exists(public_path().'/uploadfiles/image/'.$related->image_path)) {
                                            $cover = url('uploadfiles/image/'.$related->image_path);
                                        }
                                        $waktu=\Carbon\Carbon::parse($related->created_at)->diffForHumans();
                                        $wkt=text_translate($waktu,'en','id');
                                    @endphp
                                    <a href="{{ route('watch', $related->slug) }}" onclick="addhit('{{$related->id}}')"><img class="custom-size" src="{{ $cover }}" alt=""></a>
                                </div>
                                <a href="{{ route('watch', $related->slug) }}" class="title">{{ $related->title }}</a>
                                <a class="channel-name" href="{{url('video/category',strtolower(isset($related->category->name) ? $related->category->name : ''))}}">
                                    {{ isset($related->category->name) ? $related->category->name : 'No Category Name' }}
                                </a>
                                <span>
                                    <i class="fa fa-eye"></i>&nbsp;{{$related->hit}} views&nbsp;&nbsp;
                                    <i class="fa fa-clock-o"></i>&nbsp;{{$wkt}} &nbsp;&nbsp;
                                </span>
                            </div>
                            <!-- // video item -->
                        @endforeach
                        
                    </div>
                </div><!-- // col-md-4 -->
                <!-- // Related Posts -->
            </div><!-- // row -->
        @endif
@endsection
@php
$endcards=array();
if($id!=-1)
{
    $ec=App\Model\Endcards::where('video_id','=',$video->id)->get();
    foreach($ec as $k => $v)
    {
        $endcards[]=$v;
    }
}
// $ecard=str_replace(array('[',']'),'',json_encode($endcards));
$ecard=json_encode($endcards);
// echo $ecard;
@endphp

@section('footscript')
    <script src="{{asset('js/videojs.js')}}"></script>
    <script src='{{asset('js/videojs.endcard.js')}}'></script>
    <script>
        var widthvideo=$(document).width();
        var heightvideo=(parseInt(widthvideo) / 1.33);
        var ecard='{{$ecard}}';

        var en_c=JSON.parse(ecard.replace(/&quot;/g,'"'));

        // alert(en_c.length);
        var tinggi=(100 / en_c.length);
        // if(widthvideo<600)
        //     var video2 = videojs('example_video_mobile',{controls:true,height: heightvideo, width: widthvideo,autoplay: true});
            
        var video = videojs('example_video_1');
  
        function getRelatedContent(callback) 
        {
            var list = [];
            for(var x=0;x<en_c.length;x++)
            {
                var rel_content = document.createElement('div');
                var a = document.createElement('a');
                var p = document.createElement('p');
                p.innerHTML = en_c[x].title;
                a.href=en_c[x].link;
                a.appendChild(p);
                rel_content.appendChild(a);
                list.push(rel_content);
            }
            // list.push(rel_content_2);

            setTimeout(function(){
                callback(list);
            }, 0);
        }

        function getNextVid(callback) {
            // setTimeout(function(){
            //     callback(next_video);
            // }, 0);
        }

       if(widthvideo<600)
        {
            // video2.endcard({
            //     getRelatedContent: getRelatedContent,
            // // getNextVid: getNextVid, //------------------------------ uncomment this to get autoplaying video
            //     count: 8
            // });

        }
        else
        {
            video.endcard({
                getRelatedContent: getRelatedContent,
            // getNextVid: getNextVid, //------------------------------ uncomment this to get autoplaying video
                count: 8
            });

        }
        //$('div#related-content > div').css('height' , tinggi+'% !important');
    </script>
    <style>
        div#example_video_1
        {
            width:100% !important;
        }
        div#example_video_mobile
        {
            width:100% !important;
        }
        
    </style>
@endsection