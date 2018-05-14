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
        
        
        <div class="hidden-lg hidden-md" style="margin-top:10px;">&nbsp;</div>

        <div class="row margin-m-50">
            <div class="col-lg-1 col-md-1 col-sm-1">&nbsp;</div>
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <div class="row">
                        <h1 class="new-video-title" style="padding-top:0px !important;padding-bottom:0px;"><span data-letters="V"> Video Saya</h1>
                        @php
                        if(isset($videos))
                        {
                            //$no=1;
                            // shuffle($video);

                            // $eightdata = array_slice($video, 0, 12);
                            foreach($videos as $ixk => $vik)
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
                                
                                <div class="col-sm-6 col-xs-6 padding-left-right-3 hidden-lg hidden-md">
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
