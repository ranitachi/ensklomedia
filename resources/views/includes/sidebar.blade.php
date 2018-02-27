		
		{{--  <div class="col-md-2 no-padding-left no-padding-right hidden-sm hidden-xs" >  --}}
        	<div class="left-sidebar">
            	<div id="sidebar-stick">
            	<ul class="menu-sidebar" style="border-bottom:1px solid #dddddd;">
                	<li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i>Home</a></li>
                	<li><a href="{{URL::to('data-video')}}"><i class="fa fa-youtube-play"></i>Video Saya</a></li>
                	<li><a href="{{URL::to('upload')}}"><i class="fa fa-star"></i>Trending</a></li>
				</ul>
				<div style="padding-left:20px;font-weight:bold;">KATEGORI</div>
            	<ul class="menu-sidebar">
                	@php
                        $cat=App\Model\Category::orderBy('name')->get();
					@endphp

					@foreach ($cat as $v)
					@php
						$ln=strlen($v->name);
						if($ln>24)
							$cat_name=substr($v->name,0,24).' ...';
						else
							$cat_name=$v->name;
					@endphp
						<li class="color-1"><a href="{{ route('video.bycategory', $v->slug) }}"><i class="fa fa-th-large"></i>{{$cat_name}}</a></li>
					@endforeach
                </ul>
            	<!--<ul class="menu-sidebar">
                	<li><a href="#"><i class="fa fa-gear"></i>Settings</a></li>
                	<li><a href="#"><i class="fa fa-question-circle"></i>Help</a></li>
                	<li><a href="#"><i class="fa fa-send-o"></i>Send feedback</a></li>
                </ul>-->
                </div><!-- // sidebar-stick -->
                <div class="clear"></div>
            </div><!-- // left-sidebar -->
        {{--  </div>  --}}
