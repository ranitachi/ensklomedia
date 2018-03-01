{{--  <header style="position:fixed;top:0;width:100%">  --}}
<header>
        <div class="container-full">
        	<div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 hidden-lg hidden-md">
					<a id="main-category-toggler" class="hidden-md hidden-lg hidden-md"  href="#">
                    	<i class="fa fa-navicon"></i>
                    </a>
					<a id="main-category-toggler-close" class="hidden-md hidden-lg hidden-md" href="#">
                    	<i class="fa fa-close"></i>
                    </a>
                    <div id="logo">
                        <a href="{{route('dashboard')}}" ><img src="{{ asset('assets/img/logo.png')}}" alt=""></a>
                    </div>
                </div><!-- // col-md-2 -->
                <div class="col-lg-2 col-md-2 col-sm-12 hidden-sm hidden-xs">
					<a id="main-category-toggler" class="hidden-md hidden-lg hidden-md"  href="#">
                    	<i class="fa fa-navicon"></i>
                    </a>
					<a id="main-category-toggler-close" class="hidden-md hidden-lg hidden-md" href="#">
                    	<i class="fa fa-close"></i>
                    </a>
                    <div style="float:left;margin-right:20px;" class="hidden-sm hidden-xs">
                        <a href="#" id="icon-menu"><i class="fa fa fa-navicon font-like-yt" style="padding-top:8px"></i></a>
                    </div>
                    <div id="logo" style="text-align:center !important;">
                        <a href="{{route('dashboard')}}" ><img src="{{ asset('assets/img/logo.png')}}" alt="" style="width:80%"></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="search-form">
                        <form id="search" action="{{route('search.cari')}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" placeholder="Cari Video Disini" name="video-search" id="search-form" autocomplete="off"/>
                            <input type="hidden" id="video_id" value="" name="video_id">
                            <input type="submit" value="Keywords" />
                        </form>
                    </div>
                </div><!-- // col-md-3 -->
                {{--  <div class="col-lg-3 col-md-3 col-sm-5 hidden-xs hidden-sm">
                    <ul class="top-menu">
                        <li><a href="{{route('dashboard')}}">home</a></li>
                        <li><a href="{{route('trending')}}">trending</a></li>
                        <li><a href="14-history.html">history</a></li>
                    </ul>
                </div><!-- // col-md-4 -->  --}}
                <div class="col-lg-1 col-md-1 col-sm-4 hidden-xs hidden-sm">
                    &nbsp;
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs hidden-sm">
                    <div class="dropdown pull-right">
                        @php
                            if(Auth::check())
                            {
                                $init=substr(Auth::user()->email,0,1);
                                $initial='<span data-letters="'.strtoupper($init).'"></span>';
                            }
                            else
                                $initial='<img src="'.asset('assets/demo_img/user-1.png').'" alt="" class="img-shadow">';
                        @endphp
                        <a data-toggle="dropdown" href="#" class="user-area">
                            <div class="thumb2">{!!$initial!!}</div>    
                        </a>
                        <ul class="dropdown-menu account-menu">
                        @if (Auth::check())
                            <li><a href="#"><i class="fa fa-edit color-1"></i>Edit profile</a></li>
                            <li><a href="{{url('upload')}}"><i class="fa fa-upload color-2"></i>Upload video</a></li>
                            <li><a href="#"><i class="fa fa-youtube-play color-1"></i>Video Saya</a></li>
                            <li><a href="{{url('logout')}}"><i class="fa fa-sign-out color-4"></i>Logout</a></li>
                        @else
                            <li><a href="{{url('login')}}"><i class="fa fa-sign-in color-4"></i>Login</a></li>
                        @endif
                        </ul>
    				</div>
                    <ul class="top-menu pull-right">
                        <li><a href="{{URL::to('upload')}}"><i class="fa fa-upload font-like-yt"></i></a></li>
                        <li><a href="{{URL::to('upload')}}"><i class="fa fa-th font-like-yt"></i></a></li>
                        <li><a href="{{URL::to('upload')}}"><i class="fa fa-bell font-like-yt"></i></a></li>
                    </ul>
                </div>
            </div><!-- // row -->
        </div><!-- // container-full -->
      </header>