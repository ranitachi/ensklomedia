		
		{{--  <div class="col-md-2 no-padding-left no-padding-right hidden-sm hidden-xs" >  --}}
        	<div class="left-sidebar">
            	<div id="sidebar-stick">
            	<ul class="menu-sidebar" style="border-bottom:1px solid #dddddd;">
					<li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i>Home</a></li>
					@if(Auth::check())
						<li><a href="{{URL::to('data-video')}}"><i class="fa fa-youtube-play"></i>Video Saya</a></li>	
					@endif
                	<li><a href="{{URL::to('upload')}}"><i class="fa fa-star"></i>Trending</a></li>
				</ul>
            	<ul class="menu-sidebar accordion" id="accordion1">
					<li class="a-panel">
						<a data-toggle="collapse" data-parent="#accordion1" href="#firstLink" style="font-size:17px;font-weight:bold;">
							<div class="row">
								<div class="col-lg-9 col-md-9">
									KATEGORI
								</div>
								<div class="col-lg-1 col-md-1">
									<i class="fa fa-toggle-down"></i>
								</div>
								<div class="col-lg-2 col-md-2 pull-right">&nbsp;</div>
							</div>
						</a>
					</li>
					@php
						$cat=App\Model\Category::orderBy('name')->get();
						$x=0;
					@endphp
					<ul id="firstLink" class="collapse">
					@foreach ($cat as $v)
					@php
						$ln=strlen($v->name);
						if($ln>24)
							$cat_name=substr($v->name,0,24).' ...';
						else
							$cat_name=$v->name;

						$first_letter = substr($v->name,0,1);
						$x++;
					@endphp
						<li class="color-1">
							<a href="{{ route('video.bycategory', $v->slug) }}"><span data-letters="{{$first_letter}}">{{$cat_name}}</span></a>
						</li>
					@endforeach
					</ul>
					<div class="text-center">&copy; Ensiklomedia 2018</div>
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
