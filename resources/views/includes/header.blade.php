<meta name="caffeinated" content="false">
<header style="position:fixed;top:0;width:100%;z-index:100000">
{{--  <header>  --}}
        <div class="container-full">
        	<div class="row">
                <div class="row hidden-lg hidden-md" style="background:#f00;padding:10px 0;">
                    <div class="col-sm-4 col-xs-4" style="text-align:center">
                        <a href="{{url('/')}}"><i class="fa fa-home" style="font-size:20px;color:#fff"></i></a>
                    </div>
                    <div class="col-sm-4 col-xs-4" style="text-align:center">
                        <a href="{{url('trending')}}"><i class="fa fa-star" style="font-size:20px;color:#fff"></i></a>
                    </div>
                    <div class="col-sm-4 col-xs-4" style="text-align:center">
                        @if (Auth::check())
                            <a href="{{url('logout')}}"><i class="fa fa-sign-out" style="font-size:20px;color:#fff"></i></a>
                        @else
                            <a href="{{url('login')}}"><i class="fa fa-user" style="font-size:20px;color:#fff"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 hidden-lg hidden-md">
					<a id="main-category-toggler" class="hidden-md hidden-lg hidden-md"  href="#">
                    	<i class="fa fa-navicon"></i>
                    </a>
					<a id="main-category-toggler-close" class="hidden-md hidden-lg hidden-md" href="#">
                    	<i class="fa fa-close"></i>
                    </a>
                    <div id="logo">
                        <a href="{{url('/')}}" ><img src="{{ asset('assets/img/logo.png')}}" alt=""></a>
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
                        <a href="#" id="icon-menu"><i class="fa fa fa-navicon font-like-yt" id="2-icon-menu" style="width:18%;float:left;"></i></a>
                        <div id="logo" style="text-align:center !important;margin-top:-4px;width:81%;float:right;padding-top:0px;">
                            <a href="{{url('/')}}" ><img src="{{ asset('assets/img/logo.png')}}" alt=""></a>
                        </div>
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
                </div>
                
                <!-- // col-md-3 -->
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
                            <li><a href="{{url('edit-profile')}}"><i class="fa fa-edit color-1"></i>Edit profile</a></li>
                            <li><a href="{{url('upload')}}"><i class="fa fa-upload color-2"></i>Upload video</a></li>
                            <li><a href="#"><i class="fa fa-youtube-play color-1"></i>Video Saya</a></li>
                            <li><a href="{{url('logout')}}"><i class="fa fa-sign-out color-4"></i>Logout</a></li>
                        @else
                            <li><a href="{{url('login')}}"><i class="fa fa-sign-in color-4"></i>Login</a></li>
                        @endif
                        </ul>
                    </div>
                    
                    <ul class="top-menu pull-right">
                        
                        @if(Auth::check())
                        @php
                            $notif=\App\Model\Notifikasi::where('to','=',Auth::user()->id)->whereNull('seen')->orderBy('created_at','desc')->get();
                            
                            $jlh_notif=count($notif);
                        @endphp
                        @if ($jlh_notif>0)
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown"><i class="fa fa-bell-o font-like-yt"></i>
                                    <span class="badge badge-color3 header-badge" style="margin-left:-6px">{{$jlh_notif}}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-notifications-items" style="margin-top:15px !important">
                                    @foreach ($notif as $k => $v)
                                    <li>
                                        <div class="notification-info">
                                            <a href="#" style="text-transform: capitalize;"><i class="fa fa-commenting color-1"></i>
                                            {!!$v->title!!} 
                                            @php
                                                $waktu=\Carbon\Carbon::parse($v->created_at)->diffForHumans();
                                                $wkt=text_translate($waktu,'en','id');
                                            @endphp 
                                                <h5 class="time">{{$wkt}}
                                                @if ($v->url!=null)
                                                    <> <b><span style="" onclick="location.href='{{url($v->url)}}'">Klik Untuk Detail</span></b>
                                                @endif
                                                </h5>
                                            </a>
                                        </div>
                                    </li>       
                                    <li>
                                        <a href="#" class="all_notifications">All Notifications</a>
                                    </li>
                                    @endforeach
                                </ul>

                            </li>
                            @endif
                        @endif
                        <li><a href="{{URL::to('upload')}}"><i class="fa fa-upload font-like-yt"></i></a></li>
                        <li><a href="#" data-toggle="dropdown"><i class="fa fa-th font-like-yt"></i></a>
                                <ul class="dropdown-menu dropdown-notifications-items" style="margin-top:15px !important">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-4 text-center">
                                                <div class="notification-info">
                                                    <a href="http://tve.kemdikbud.go.id" target="_blank">
                                                    <img src="{{asset('assets/img/Tve_logo.png')}}">
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 text-center">
                                                 <div class="notification-info">
                                                    <a href="http://suaraedukasi.kemdikbud.go.id" target="_blank">
                                                    <img src="{{asset('assets/img/suaraedukasi.gif')}}">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                 <div class="notification-info">
                                                    <a href="http://tve.kemdikbud.go.id/vod" target="_blank">
                                                    <img src="{{asset('assets/img/logo_vodtve.png')}}">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-8 text-center">
                                                 <div class="notification-info">
                                                    <a href="http://belajar.kemdikbud.go.id" target="_blank">
                                                    <img src="{{asset('assets/img/logo_rumah_belajar_gab.png')}}">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <div class="notification-info">
                                                    <a href="http://tve.kemdikbud.go.id/kihajar" target="_blank">
                                                    <img src="{{asset('assets/img/logoanugerahkihajar.jpg')}}">
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                    </li>
                                    
                                </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- // row -->
        </div><!-- // container-full -->
      </header>