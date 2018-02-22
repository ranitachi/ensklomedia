<header>
        <div class="container-full">
        	<div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12">
					<a id="main-category-toggler" class="hidden-md hidden-lg hidden-md"  href="#">
                    	<i class="fa fa-navicon"></i>
                    </a>
					<a id="main-category-toggler-close" class="hidden-md hidden-lg hidden-md" href="#">
                    	<i class="fa fa-close"></i>
                    </a>
                    <div id="logo">
                        <a href="{{route('dashboard')}}"><img src="{{ asset('assets/img/logo.png')}}" alt=""></a>
                    </div>
                </div><!-- // col-md-2 -->
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="search-form">
                        <form id="search" action="{{route('search.cari')}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" placeholder="Cari Video Disini" name="video-search" id="search-form" autocomplete="off"/>
                            <input type="hidden" id="video_id" value="" name="video_id">
                            <input type="submit" value="Keywords" />
                        </form>
                    </div>
                </div><!-- // col-md-3 -->
                <div class="col-lg-3 col-md-3 col-sm-5 hidden-xs hidden-sm">
                    <ul class="top-menu">
                        <li><a href="{{route('dashboard')}}">home</a></li>
                        <li><a href="{{route('trending')}}">trending</a></li>
                        <li><a href="14-history.html">history</a></li>
                    </ul>
                </div><!-- // col-md-4 -->
                <div class="col-lg-2 col-md-2 col-sm-4 hidden-xs hidden-sm">
                    &nbsp;
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 hidden-xs hidden-sm">
					  <div class="dropdown">
                        <a data-toggle="dropdown" href="#" class="user-area">
                            <div class="thumb"><img src="{{ asset('assets/demo_img/user-1.png')}}" alt=""></div>
                            <h2>Rabie Elkheir</h2>
                            <h3>25 subscribers</h3>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu account-menu">
                           <li><a href="#"><i class="fa fa-edit color-1"></i>Edit profile</a></li>
                           <li><a href="#"><i class="fa fa-video-camera color-2"></i>add video</a></li>
                           <li><a href="#"><i class="fa fa-star color-3"></i>Favorites</a></li>
                           <li><a href="#"><i class="fa fa-sign-out color-4"></i>sign out</a></li>
                        </ul>
    				</div>
                </div>
            </div><!-- // row -->
        </div><!-- // container-full -->
      </header>