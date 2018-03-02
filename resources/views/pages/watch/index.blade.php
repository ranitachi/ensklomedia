@extends('layouts.master')

@section('title')
    <title>Lihat Video - Ensiklomedia</title>
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
            <div class="row hidden-lg hidden-md">
                <div class="col-xs-12 col-sm-12 no-padding-all">
                    <video id="example_video_mobile" class="video-js vjs-default-skin vjs-big-play-centered" autoplay controls preload="auto">
                        <source src="{{$vid}}" type="{{$mime}}" />
                    </video>
                </div>
                
                <div class="col-xs-12 col-sm-12 no-padding-all" style="margin:0px !important">
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
                <div class="col-md-8 hidden-sm hidden-xs">
                	<div id="watch">

                        <!-- Video Player -->
                        <h1 class="video-title">{{($id==-1 ? 'Video Tidak Tersedia' : $video->title)}}</h1>
                        <div class="video-code">
                             <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
                                controls preload="auto" height="400">

                                <source src="{{$vid}}" type="{{$mime}}" />
                            </video>
                            <!--<iframe width="100%" height="415" src="https://www.youtube.com/embed/e452W2Kj-yg" frameborder="0" allowfullscreen></iframe>-->
						</div><!-- // video-code -->

                        <div class="video-share">
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
                                                    {{ $comment->video->user->profile->name }}
                                                </a>
                                                <time datetime="2017-03-24T18:18">July 27, 2014 - 11:00 PM</time>
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
        
                                <h3 class="post-box-title">Add Comments</h3>

                                <form>
                                    <textarea class="form-control" rows="8" id="Message" placeholder="COMMENT" v-model="maincomment"></textarea>
                                    <button type="button" id="contact_submit" class="btn btn-dm" v-on:click="postmaincomment">Post Comment</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Posts-->
                <div class="col-md-4 col-sm-12 col-xs-12">
                	<div id="related-posts" style="padding:0px !important;margin:0px !important;">
                        @foreach ($relatedvideo as $related)
                            <!-- video item -->
                            <div class="related-video-item">
                                <div class="thumb">
                                    <small class="time">10:53</small>
                                    @php
                                        $cover = "http://ensiklomedia.kemdikbud.go.id/uploads/images/".$related->image_path;
                                        if (File::exists($related->image_path)) {
                                            $cover = url('uploadfiles/image/'.$related->image_path);
                                        }
                                    @endphp
                                    <a href="{{ route('watch', $related->slug) }}" onclick="addhit('{{$related->id}}')"><img class="custom-size" src="{{ $cover }}" alt=""></a>
                                </div>
                                <a href="{{ route('watch', $related->slug) }}" class="title">{{ $related->title }}</a>
                                <a class="channel-name" href="#">
                                    {{ isset($related->user->profile->channel_name) ? $related->user->profile->channel_name : 'No Channel Name' }}
                                    <span><i class="fa fa-check-circle"></i></span>
                                </a>
                            </div>
                            <!-- // video item -->
                        @endforeach
                        
                    </div>
                </div><!-- // col-md-4 -->
                <!-- // Related Posts -->
            </div><!-- // row -->
		
@endsection


@section('footscript')

    <script src="{{asset('js/videojs.js')}}"></script>
    <script src='{{asset('js/videojs.endcard.js')}}'></script>
    <script>
        //videojs(document.getElementById('example_video_1'), {}, function() {
            // This is functionally the same as the previous example.
        //});
        var widthvideo=$(document).width();
        var heightvideo=(parseInt(widthvideo) / 1.33);
        // alert(widthvideo);
        var video2 = videojs('example_video_mobile',{height: heightvideo, width: widthvideo});

        var video = videojs('example_video_1');
        var rel_content_1 = document.createElement('div');
        var a1 = document.createElement('a');
        var p1 = document.createElement('p');
        p1.innerHTML = "Video JS Website, For All Your HTML5 Needs.... AND MORE!";
        a1.href = "http://www.videojs.com/";
        a1.appendChild(p1);
        rel_content_1.appendChild(a1);

        var rel_content_2 = document.createElement('div');
        var a2 = document.createElement('a');
        var p2 = document.createElement('p');
        p2.innerHTML = "This Man Found a LinkBait LinkBait. You Won't Believe What the LinkBait Did Next!";
        a2.href = "http://www.youtube.com/watch?v=6k3--GPk-l4";
        a2.appendChild(p2);
        rel_content_2.appendChild(a2);

        var next_video = document.createElement('div');
        var a3 = document.createElement('a');
        var p3 = document.createElement('p');
        p3.innerHTML = "ABOUT TO GO HERE!!";
        a3.href = "http://www.youtube.com/watch?v=KAv500Q6bfA";
        a3.appendChild(p3);
        next_video.appendChild(a3);

        // Asynchronous functions
        function getRelatedContent(callback) {
        var list = [];
        list.push(rel_content_1);
        list.push(rel_content_2);

        setTimeout(function(){
            callback(list);
        }, 0);
        }

        function getNextVid(callback) {
        setTimeout(function(){
            callback(next_video);
        }, 0);
        }

        video.endcard({
        getRelatedContent: getRelatedContent,
        getNextVid: getNextVid, //------------------------------ uncomment this to get autoplaying video
        count: 8
        });

        // var heightvideo=$('#example_video_mobile_html5_api').height();
        
        // $('div#example_video_mobile').css({'width':widthvideo+'px !important','height':heightvideo+'px !important'});
        // $('#example_video_mobile').attr({'height':heightvideo});
        // alert(widthvideo+'-'+heightvideo);
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