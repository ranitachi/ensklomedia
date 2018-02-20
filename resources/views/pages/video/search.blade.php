@extends('layouts.master')

@section('title')
    <title>Lihat Video - Ensiklomedia</title>
     <link href="{{asset('css/videojs.css')}}" rel="stylesheet">
@endsection

@section('content')
        <div id="all-output" class="col-md-10">
            <div class="row">
            	<!-- Watch -->
                <div class="col-md-8">
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
                	<div id="related-posts">

                    	<!-- video item -->
                        <div class="related-video-item">
                        	<div class="thumb">
                                <small class="time">10:53</small>
                            	<a href="#"><img src="{{ asset('assets/demo_img/v1.png')}}" alt=""></a>
                            </div>
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                        </div>
                    	<!-- // video item -->


                    	<!-- video item -->
                        <div class="related-video-item">
                        	<div class="thumb">
                                <small class="time">10:53</small>
                            	<a href="#"><img src="{{ asset('assets/demo_img/v2.png')}}" alt=""></a>
                            </div>
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                        </div>
                    	<!-- // video item -->


                    	<!-- video item -->
                        <div class="related-video-item">
                        	<div class="thumb">
                                <small class="time">10:53</small>
                            	<a href="#"><img src="{{ asset('assets/demo_img/v3.png')}}" alt=""></a>
                            </div>
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                        </div>
                    	<!-- // video item -->


                    	<!-- video item -->
                        <div class="related-video-item">
                        	<div class="thumb">
                                <small class="time">10:53</small>
                            	<a href="#"><img src="{{ asset('assets/demo_img/v4.png')}}" alt=""></a>
                            </div>
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                        </div>
                    	<!-- // video item -->


                    	<!-- video item -->
                        <div class="related-video-item">
                        	<div class="thumb">
                                <small class="time">10:53</small>
                            	<a href="#"><img src="{{ asset('assets/demo_img/v5.png')}}" alt=""></a>
                            </div>
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                        </div>
                    	<!-- // video item -->


                    	<!-- video item -->
                        <div class="related-video-item">
                        	<div class="thumb">
                                <small class="time">10:53</small>
                            	<a href="#"><img src="{{ asset('assets/demo_img/v6.png')}}" alt=""></a>
                            </div>
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                        </div>
                    	<!-- // video item -->

                    	<!-- video item -->
                        <div class="related-video-item">
                        	<div class="thumb">
                                <small class="time">10:53</small>
                            	<a href="#"><img src="{{ asset('assets/demo_img/v1.png')}}" alt=""></a>
                            </div>
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                        </div>
                    	<!-- // video item -->


                    	<!-- video item -->
                        <div class="related-video-item">
                        	<div class="thumb">
                                <small class="time">10:53</small>
                            	<a href="#"><img src="{{ asset('assets/demo_img/v4.png')}}" alt=""></a>
                            </div>
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                        </div>
                    	<!-- // video item -->


                    	<!-- video item -->
                        <div class="related-video-item">
                        	<div class="thumb">
                                <small class="time">10:53</small>
                            	<a href="#"><img src="{{ asset('assets/demo_img/v3.png')}}" alt=""></a>
                            </div>
                            <a href="#" class="title">Lorem Ipsum is simply dummy text of the printing and </a>
                            <a class="channel-name" href="#">Rabie Elkheir<span>
                            <i class="fa fa-check-circle"></i></span></a>
                        </div>
                    	<!-- // video item -->

                    </div>
                </div><!-- // col-md-4 -->
                <!-- // Related Posts -->
            </div><!-- // row -->
		</div>
@endsection
@section('footscript')
    <script src="{{asset('js/videojs.js')}}"></script>
    <script>
        videojs(document.getElementById('example_video_1'), {}, function() {
            // This is functionally the same as the previous example.
        });
    </script>
    <style>
        div#example_video_1
        {
            width:100% !important;
        }
    </style>
@endsection