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
        <div>
            <div class="row">
            	<!-- Watch -->
                <div class="col-md-8">
                	<div id="watch">

                        <!-- Video Player -->
                        <div class="video-code">
                             <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
                                controls preload="auto" height="400">

                                <source src="{{$vid}}" type="{{$mime}}" />
                            </video>
                            <!--<iframe width="100%" height="415" src="https://www.youtube.com/embed/e452W2Kj-yg" frameborder="0" allowfullscreen></iframe>-->
						</div><!-- // video-code -->

                        <h1 class="video-title title-watch">{{($id==-1 ? 'Video Tidak Tersedia' : ucwords(strtolower($video->title)))}}</h1>

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
                        			<span class="subscribers" style="text-transform:capitalize !important">{{($id==-1 ? 'Video Tidak Tersedia' : $video->description)}}</span>
                        		</div>
                        		
                        	</div>
                        <!-- // Chanels Item -->


                        <!-- Comments -->
                        <div id="comments" class="post-comments">
                        	<h3 class="post-box-title"><span>19</span> Comments</h3>
                            <ul class="comments-list">
                            	<li>
                                	<div class="post_author">
                                    	<div class="img_in">
                                        	<a href="#"><img src="{{ asset('assets/demo_img/c1.jpg')}}" alt=""></a>
                                        </div>
                                        <a href="#" class="author-name">Rabie Elkheir</a>
                                        <time datetime="2017-03-24T18:18">July 27, 2014 - 11:00 PM</time>
                                    </div>
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>
                                    <a href="#" class="reply">Reply</a>

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
                                            <a href="#" class="reply">Reply</a>
                                        </li>
                                    </ul>


                                </li>
                            	<li>
                                	<div class="post_author">
                                    	<div class="img_in">
                                        	<a href="#"><img src="{{ asset('assets/demo_img/c2.jpg')}}" alt=""></a>
                                        </div>
                                        <a href="#" class="author-name">Salam Ahmmed</a>
                                        <time datetime="2017-03-24T18:18">July 27, 2014 - 11:00 PM</time>
                                    </div>
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>
                                    <a href="#" class="reply">Reply</a>
                                </li>

                            </ul>


                        	<h3 class="post-box-title">Add Comments</h3>
                            <form>
                               <input type="text" class="form-control" id="Name" placeholder="YOUR NAME">
                               <input type="email" class="form-control" id="Email" placeholder="EMAIL">
                               <input type="text" class="form-control" placeholder="WEBSITE">
                               <textarea class="form-control" rows="8" id="Message" placeholder="COMMENT"></textarea>
                               <button type="button" id="contact_submit" class="btn btn-dm">Post Comment</button>
                           </form>
                        </div>
                        <!-- // Comments -->


                    </div><!-- // watch -->
                </div><!-- // col-md-8 -->
                <!-- // Watch -->

                <!-- Related Posts-->
                <div class="col-md-4">
                	<div id="related-posts" style="padding:0px !important;margin:20px 0px 0x 0px !important;">
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
                                        $waktu=\Carbon\Carbon::parse($related->created_at)->diffForHumans();
                                        $wkt=text_translate($waktu,'en','id');
                                    @endphp
                                    <a href="{{ route('watch', $related->slug) }}" onclick="addhit('{{$related->id}}')"><img class="custom-size" src="{{ $cover }}" alt=""></a>
                                </div>
                                <a href="{{ route('watch', $related->slug) }}" class="title">{{ $related->title }}</a>
                                <a class="channel-name" href="#">
                                    {{ isset($related->category->name) ? $related->category->name : 'No Category Name' }}
                                </a>
                                <span>
                                    <i class="fa fa-eye"></i>&nbsp;{{$related->hit}} views&nbsp;&nbsp;
                                    <i class="fa fa-eye"></i>&nbsp;{{$wkt}} &nbsp;&nbsp;
                                </span>
                            </div>
                            <!-- // video item -->
                        @endforeach

                    </div>
                </div><!-- // col-md-4 -->
                <!-- // Related Posts -->
            </div><!-- // row -->
		</div>
@endsection
@section('footscript')
    <script src="{{asset('js/videojs.js')}}"></script>
    <script src='{{asset('js/videojs.endcard.js')}}'></script>
    <script>
        var widthvideo=$(document).width();
        var heightvideo=(parseInt(widthvideo) / 1.33);
        // alert(widthvideo);
        if(widthvideo<600)
            var video2 = videojs('example_video_mobile',{height: heightvideo, width: widthvideo,autoplay: true});
            
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
    </script>
    <style>
        div#example_video_1
        {
            width:100% !important;
        }
    </style>
@endsection