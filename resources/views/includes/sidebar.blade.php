		
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
				@if(Auth::check())
					@if(Auth::user()->authorization_level==0)
					<ul class="menu-sidebar" style="border-bottom:1px solid #dddddd;">
						<li><a href="{{URL::to('user')}}"><i class="fa fa-users"></i>Pengguna</a></li>
						<li><a href="{{URL::to('category')}}"><i class="fa fa-files-o"></i>Kategori</a></li>
						{{--  <li><a href="{{URL::to('setting')}}"><i class="fa fa-cogs"></i>Pengaturan</a></li>	  --}}
						<ul class="accordion" id="accordion-setting">
							<li class="a-panel">
								<div class="row">
									<a data-toggle="collapse" data-parent="#accordion-setting" href="#linkawal">
										<div class="col-lg-9 col-md-9">
											<i class="fa fa-cogs"></i>Pengaturan
										</div>
										<div class="col-lg-1 col-md-1">
											<i class="fa fa-toggle-down"></i>
										</div>
										
									</a>
								</div>
							</li>
							<ul id="linkawal" class="collapse" style="margin-left:10px !important;padding-top:10 !important;">
								@if (Auth::check())
									@if(Auth::user()->authorization_level==0)
										<li class="color-1"><a href="{{url('mapping-admin')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Mapping Admin</a>
									@endif
								@endif
								{{--  <li class="color-1"><a href="{{url('tahun-berjalan')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Tahun Berjalan</a>
								<li class="color-1"><a href="{{url('bidang')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Bidang</a>
								<li class="color-1"><a href="{{url('sub-bidang')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Sub Bidang</a>
								<li class="color-1"><a href="{{url('update-time')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Update Time</a>  --}}
							</ul>
						</ul>
					</ul>
					@endif
				@endif
				@if(Auth::check())
					@if(Auth::user()->authorization_level==1)
					<ul class="menu-sidebar" style="border-bottom:1px solid #dddddd;">
						<ul class="accordion" id="accordion-setting">
							<li class="a-panel">
								<div class="row">
									<a data-toggle="collapse" data-parent="#accordion-setting" href="#linkawal">
										<div class="col-lg-9 col-md-9">
											<i class="fa fa-cogs"></i>Pengaturan
										</div>
										<div class="col-lg-1 col-md-1">
											<i class="fa fa-toggle-down"></i>
										</div>
										
									</a>
								</div>
							</li>
							<ul id="linkawal" class="collapse" style="margin-left:10px !important;padding-top:10 !important;">
								<li class="color-1"><a href="{{url('mapping-super-user')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Mapping Super User</a>
								<li class="color-1"><a href="{{url('mapping-reviewer')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Mapping Reviewer</a>
								<li class="color-1"><a href="{{url('mapping-reviewer-video')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Mapping Video ke Reviewer</a>
							</ul>
						</ul>
					</ul>
					@elseif(Auth::user()->authorization_level==2)
					<ul class="menu-sidebar" style="border-bottom:1px solid #dddddd;">
						<ul class="accordion" id="accordion-setting">
							<li class="a-panel">
								<div class="row">
									<a data-toggle="collapse" data-parent="#accordion-setting" href="#linkawal">
										<div class="col-lg-9 col-md-9">
											<i class="fa fa-cogs"></i>Pengaturan
										</div>
										<div class="col-lg-1 col-md-1">
											<i class="fa fa-toggle-down"></i>
										</div>
										
									</a>
								</div>
							</li>
							<ul id="linkawal" class="collapse" style="margin-left:10px !important;padding-top:10 !important;">
								<li class="color-1"><a href="{{url('video-verifikasi')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Verifikasi Video</a>
								
							</ul>
						</ul>
					</ul>
					@endif
				@endif
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
