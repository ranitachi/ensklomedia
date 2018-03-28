@extends('layouts.master')

@section('title')
    <title>Beranda - Ensiklomedia</title>
     <link href="{{asset('css/videojs.css')}}" rel="stylesheet">
@endsection

@section('content')
        <div class="row margin-m-100">
            <div class="col-lg-12 col-md-12 col-cm-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1">&nbsp;</div>
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <div class="row">
                        <h1 class="new-video-title" style="padding-top:0px !important;padding-bottom:0px;"><span data-letters="V"> Video Favorit</h1>
                        @php
                        if(isset($video))
                        {
                            //$no=1;
                            shuffle($video);

                            $eightdata = array_slice($video, 0, 12);
                            foreach($eightdata as $ixk => $vik)
                            {
                                $cover="http://ensiklomedia.kemdikbud.go.id/uploads/images/".$vik->image_path;
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
                                    $vid="http://ensiklomedia.kemdikbud.go.id/uploads/videos/".$vik->video_path;
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
                                        $cvr = url($cv);
                                        //$durasi='';
                                        $img_dikaji='1';
                                    }
                                    else
                                        $img_dikaji='';
                                
                        @endphp
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 margin-left-right-2 col-custom hidden-sm hidden-xs">
                                    <div class="video-item">
                                        <div class="thumb" style="background:url(assets/img/no-image-02.png);background-size:90% 100%;background-position:center;border:1px solid #ccc;">
                                            @if($img_dikaji=='1')
                                                <div class="hover-efect ribbon"><i class="fa fa-info-circle" style="color:white !important"></i>&nbsp;&nbsp;Belum Dikaji</div>
                                            @else
                                                <div class="hover-efect"></div>
                                            @endif
                                                <small class="time">{{$durasi}}</small>
                                            <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')"><img src="{{ $cover}}" alt="" style="height:118px;width:210px">
                                        </div>
                                        
                                        <div class="video-info">
                                            <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')" class="title">{{(($vik->title))}}</a>
                                            <a class="channel-name" href="#">{{$kategori}}</a>
                                                <span class="views"><i class="fa fa-eye"></i>{{$vik->hit}} views </span>
                                                <span class="date"><i class="fa fa-clock-o"></i>{{trim($wkt)}}</span>
                                         </div>
                                    </div>
                                </div>  
                                
                                <div class="col-sm-12 col-xs-12 padding-left-right-3 hidden-lg hidden-md">
                                    <div class="video-item">
                                        <div class="thumb" style="background:url(assets/img/no-image-02.png);background-size:90% 100%;background-position:center;border:1px solid #ccc;">
                                            @if($img_dikaji=='1')
                                                <div class="hover-efect ribbon"><i class="fa fa-info-circle" style="color:white !important"></i>&nbsp;&nbsp;Belum Dikaji</div>
                                            @else
                                                <div class="hover-efect"></div>
                                            @endif
                                                <small class="time">{{$durasi}}</small>
                                            <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')">
                                            <img src="{{ $cover}}" alt="" style="width:100%"></a>
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
        function addhit(id)
        {
            $.ajax({
                url : APP_URL+'/video-add-hit/'+id,
                success : function(a){
                }
            });
        }
    </script>
    <style>
        div#example_video_1
        {
            /*width:100% !important;*/
        }
    </style>
@endsection