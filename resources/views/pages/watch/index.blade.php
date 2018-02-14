@extends('layouts.master')

@section('title')
    <title>Lihat Video - Ensiklomedia</title>
@endsection

@section('content')
        <div id="all-output" class="col-md-12">
            <div class="row">
            	<!-- Watch -->
                <div class="col-md-8">
                	<div id="watch">

                        <!-- Video Player -->
                        <h1 class="video-title">Lorem Lpsum Is Simply Dummy Text Of The Printing</h1>
                        <div class="video-code">
                            <iframe width="100%" height="415" src="https://www.youtube.com/embed/e452W2Kj-yg" frameborder="0" allowfullscreen></iframe>
						</div><!-- // video-code -->

                        <div class="video-share">
                        	<ul class="like">
                            	<li><a class="deslike" href="#">1250 <i class="fa fa-thumbs-down"></i></a></li>
                            	<li><a class="like" href="#">1250 <i class="fa fa-thumbs-up"></i></a></li>
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
                        		<div class="chanel-thumb">
                        			<a href="#"><img src="{{ asset('assets/demo_img/ch-1.jpg')}}" alt=""></a>
                        		</div>
                        		<div class="chanel-info">
                        			<a class="title" href="#">Rabie Elkheir</a>
                        			<span class="subscribers">436,414 subscribers</span>
                        		</div>
                        		<a href="#" class="subscribe">Subscribe</a>
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
<style>
    body:after
    {
        background-color:#e6e6e6 !important;
    }
</style>