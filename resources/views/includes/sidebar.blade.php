<div class="col-md-2 no-padding-left hidden-sm hidden-xs">
        	<div class="left-sidebar">
            	<div id="sidebar-stick" >
            	<ul class="menu-sidebar">
                	<li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i>Home</a></li>
                	<li><a href="{{URL::to('data-video')}}"><i class="fa fa-file-text"></i>Video Saya</a></li>
                	<li><a href="{{URL::to('upload')}}"><i class="fa fa-upload"></i>Upload</a></li>
				</ul>
				Kategori
            	<ul class="menu-sidebar">
                	@php
                        $cat=App\Model\Category::orderBy('name')->get();
					@endphp

                    @foreach ($cat as $v)
						<li class="color-1"><a href="{{ route('video.bycategory', $v->id) }}"><i class="fa fa-th-large"></i>{{$v->name}}</a></li>
					@endforeach
                </ul>
            	<ul class="menu-sidebar">
                	<li><a href="#"><i class="fa fa-gear"></i>Settings</a></li>
                	<li><a href="#"><i class="fa fa-question-circle"></i>Help</a></li>
                	<li><a href="#"><i class="fa fa-send-o"></i>Send feedback</a></li>
                </ul>
                </div><!-- // sidebar-stick -->
                <div class="clear"></div>
            </div><!-- // left-sidebar -->
        </div>
