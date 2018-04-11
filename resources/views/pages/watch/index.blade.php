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
            <div class="row margin-m-100"></div>
            <div class="row hidden-lg hidden-md">
                <div class="col-xs-12 col-sm-12 no-padding-all margin-m-50">
                    <video class="hidden-lg hidden-md" preload="" controls="" style="width:100%;height:auto;">
                        <source src="{{$vid}}"/>
                    </video>
                    {{--  <video id="playvid" style="width:100%;height:auto;" preload="" controls="">
                        <source src="https://www.kemdikbud.go.id/main/uploads/default/videos/PPK.mp4">
                    </video>  --}}
                    {{--  <iframe src="https://www.kemdikbud.go.id/main/uploads/default/videos/PPK.mp4" style="width:100%;height:330px;border:0px "></iframe>  --}}
                </div>
                
                <div class="col-xs-12 col-sm-12 no-padding-all" style="margin:0px !important">
                <h1 class="video-title title-watch">{{($id==-1 ? 'Video Tidak Tersedia' : ucwords(strtolower($video->title)))}} {!!(is_null($video->approved_by) ? rating(0) : '')!!}</h1>
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
                            $cover="http://ensiklomedia.kemdikbud.go.id/uploads/images/".$video->image_path;
                            if(File::exists(public_path().'/uploadfiles/image/'.$video->image_path))
                            {
                                $cv = 'uploadfiles/image/'.$video->image_path;
                                $cover = url($cv);
                            }

                                    if(is_null($video->approved_by))
                                    {
                                        $cv = 'assets/img/belum-dikaji.jpg';
                                        // $cover = url($cv);
                                        $durasi='';
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
                        <h1 class="video-title title-watch">
                            
                            @if(is_null($video->approved_by))
                                {!!rating(0)!!}
                            @endif

                            {{($id==-1 ? 'Video Tidak Tersedia' : ucwords(strtolower($video->title)))}} 
                        </h1>

                        <div class="video-share">
                        	<ul class="like">
                                @php
                                    $waktu=\Carbon\Carbon::parse($video->created_at)->diffForHumans();
                                    $wkt=text_translate($waktu,'en','id');
                                @endphp
                                <li><a class="like" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;{{($id==-1 ? 0 : $video->hit)}} views</i></a></li>
                                <li><a class="like" href="#"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{date('d-m-Y',strtotime($video->created_at))}} :: {{($id==-1 ? 0 : $wkt)}}</i></a></li>
                            </ul>
                            @if (Auth::check())
                                @if (!isset($saung[$video->id][Auth::user()->id]))
                                    <ul class="like pull-right">
                                        <li>
                                            <div>
                                                {{-- <a href="{{url('buat-saung/'.$video->slug)}}" class="btn btn-sm btn-primary"><i class="fa fa-clone"></i>&nbsp;Buka Saung Diskusi</a> --}}
                                                <a href="javascript:gabungsaung('{{$video->slug}}','{{$video->title}}','{{$video->id}}')" class="btn btn-sm btn-success"><i class="fa fa-clone"></i>&nbsp;Gabung Saung Diskusi</a>

                                                <a href="javascript:bukasaung('{{$video->slug}}','{{$video->title}}','{{$video->id}}')" class="btn btn-sm btn-primary"><i class="fa fa-clone"></i>&nbsp;Buka Saung Diskusi</a>
                                            </div>
                                        </li>
                                    </ul>
                                @endif
                            @endif
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
                        <div id="app">
                            <div id="comments" class="post-comments">
                                <h3 class="post-box-title"><span> {{ $comments->count() }} </span> Comments</h3>

                                @foreach ($comments as $comment)
                                    <ul class="comments-list">
                                        <li>
                                            <div class="post_author">
                                                <div class="img_in">
                                                    <a href="#"><img src="{{ asset('assets/demo_img/c1.jpg')}}" alt=""></a>
                                                </div>
                                                <a href="#" class="author-name">
                                                    {{ isset($comment->user->profile->name) ? $comment->user->profile->name : '' }}
                                                </a>
                                                <time datetime="2017-03-24T18:18">{{date('d-m-Y H:i:s', strtotime($comment->created_at))}}</time>
                                            </div>
                                            <p>
                                                {{ $comment->comment }}
                                            </p>
                                            {{--  <a class="reply">Reply</a>

                                            <div style="margin-top:10px;" v-show="replybox">
                                                <form>
                                                    <textarea class="form-control" rows="2" id="Message" placeholder="COMMENT" v-model="replycomment"></textarea>
                                                    <button type="button" id="contact_submit" class="btn btn-dm" v-on:click="postreplybox">Post Comment</button>
                                                </form>
                                            </div>
                                            <br>

                                            <ul class="children">
                                                <li>
                                                    <div class="post_author">
                                                        <div class="img_in">
                                                            <a href="#"><img src="{{ asset('assets/demo_img/c2.jpg')}}" alt=""></a>
                                                        </div>
                                                        <a href="#" class="author-name">Salam Ahmmed</a>
                                                        <time datetime="2017-03-24T18:18">July 27, 2014 - 11:00 PM</time>
                                                    </div>
                                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>
                                                </li>
                                            </ul>  --}}

                                        </li>
                                    </ul>
                                @endforeach
        
                                @if (Auth::check())
                                    <h3 class="post-box-title">Add Comments</h3>

                                    <form action="{{ route('comments.store') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="slug" value="{{ $slug }}">
                                        <textarea class="form-control" rows="8" id="Message" placeholder="COMMENT" v-model="maincomment" name="comment"></textarea>
                                        <button type="submit" id="contact_submit" class="btn btn-dm" v-on:click="postmaincomment">Post Comment</button>
                                    </form>
                                @else
                                    <a class="btn btn-dm" href="{{ route('login') }}">Please login first to post a comment</a>
                                @endif

                            </div>
                        </div>
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
                            <div class="related-video-item" style="margin-left:5px;">
                                <div class="thumb">
                                    
                                    <div class="hover-efect"></div>
                                    
                                    <small class="time">{{$durasi}}</small>
                                    @php
                                        $cover = "http://ensiklomedia.kemdikbud.go.id/uploads/images/".$related->image_path;
                                        if (File::exists(public_path().'/uploadfiles/image/'.$related->image_path)) {
                                            $cover = url('uploadfiles/image/'.$related->image_path);
                                        }
                                        $waktu=\Carbon\Carbon::parse($related->created_at)->diffForHumans();
                                        $wkt=text_translate($waktu,'en','id');
                                    @endphp
                                    <a href="{{ route('watch', $related->slug) }}" onclick="addhit('{{$related->id}}')"><img class="custom-size" src="{{ $cover }}" alt=""></a>
                                </div>
                                {!!rating(0)!!}
                                
                                <a href="{{ route('watch', $related->slug) }}" class="title">{{ $related->title }}</a>
                                <a class="channel-name" href="{{ isset($related->category->name) ? url('video/category',strtolower($related->category->name)) : ''}}">
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
// echo '<pre>';
// print_r($endcards);
// echo '</pre>';
// echo $ecard;
@endphp

@section('footscript')

    <script src="{{asset('js/videojs.js')}}"></script>
    <script src='{{asset('js/videojs.endcard.js')}}'></script>
    <script>
        function bukasaung(slug,judul,idvid)
        {
            $('#content-body').html('<h1 style="color:#000">Apakah Anda Yakin ingin Membuka Saung Diskusi untuk Video : '+judul+' ?</h1>');
            $('#modal_default').modal('show');
            $('#ok').click(function(){
                $.ajax({
                    url : APP_URL+'/create-saung/'+idvid,
                    dataType: 'json',
                    cache: false,
                }).done(function(data){
                    location.href=APP_URL+'/form-biodata/'+idvid+'/-1';

                }).fail(function(){
                    var txt = "Buka Saung Diskusi Baru Tidak Berhasil";
                    
                    $.notify(txt, {
                        elementPosition: 'bottom right',
                        className : 'error',
                        globalPosition: 'buttom right',
                    });
                });
            });
        }
        function gabungsaung(slug,judul,idvid)
        {
            $('#content-body').html('<h1 style="color:#000">Apakah Anda Yakin ingin Bergabung pada Saung Diskusi ini ?</h1>');
            $('#modal_default').modal('show');
            $('#ok').click(function(){
                $.ajax({
                    url : APP_URL+'/join-saung/'+idvid,
                    dataType: 'json',
                    cache: false,
                }).done(function(data){
                    // location.href=APP_URL+'/buka-saung/'+slug;
                    location.href=APP_URL+'/edit-profile';
                }).fail(function(){
                    var txt = "Gabung Saung Diskusi Baru Tidak Berhasil";    
                    $.notify(txt, {
                        elementPosition: 'bottom right',
                        className : 'error',
                        globalPosition: 'buttom right',
                    });
                });
            });
        }
        var widthvideo=$(document).width();
        var heightvideo=(parseInt(widthvideo) / 1.33);
        var ecard='{{$ecard}}';

        var en_c=JSON.parse(ecard.replace(/&quot;/g,'"'));

        // alert(en_c.length);
        var tinggi=(100 / en_c.length);
        // if(widthvideo<600)
        //     var video2 = videojs('example_video_mobile',{controls:true,height: heightvideo, width: widthvideo,autoplay: true});
            
        var video = videojs('example_video_1');
        var ls=[];
        
        //alert(en_c[0].title);
        
        // var rel_content_1 = document.createElement('div');
        // var a1 = document.createElement('a');
        // var p1 = document.createElement('p');
        // p1.innerHTML = "Video JS Website, For All Your HTML5 Needs.... AND MORE!";
        // a1.href = "http://www.videojs.com/";
        // a1.appendChild(p1);
        // rel_content_1.appendChild(a1);

        // var rel_content_2 = document.createElement('div');
        // var a2 = document.createElement('a');
        // var p2 = document.createElement('p');
        // p2.innerHTML = "This Man Found a LinkBait LinkBait. You Won't Believe What the LinkBait Did Next!";
        // a2.href = "http://www.youtube.com/watch?v=6k3--GPk-l4";
        // a2.appendChild(p2);
        // rel_content_2.appendChild(a2);

        // var next_video = document.createElement('div');
        // var a3 = document.createElement('a');
        // var p3 = document.createElement('p');
        // p3.innerHTML = "ABOUT TO GO HERE!!";
        // a3.href = "http://www.youtube.com/watch?v=KAv500Q6bfA";
        // a3.appendChild(p3);
        // next_video.appendChild(a3);

        // Asynchronous functions
        function getRelatedContent(callback) 
        {
            var list = [];
            for(var x=0;x<en_c.length;x++)
            {
                var rel_content = document.createElement('div');
                var a = document.createElement('a');
                var p = document.createElement('p');
                var link =en_c[x].link;
                p.innerHTML = en_c[x].title;
                p.setAttribute('id_'+x, x);
                // a.href=en_c[x].link;
                p.addEventListener("click", function (i) {
                    alert(p.getAttribute('id_'+x));
                });

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