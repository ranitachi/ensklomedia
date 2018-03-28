<div id="main-category">
        <div class="container-full">
        	<div class="row">
                <div class="col-md-12">
                    <ul class="main-category-menu">
                    @if(Auth::check())
                        <li><a href="{{url('data-video')}}"><i class="fa fa-youtube-play color-2"></i>Video Saya</a></li>
                        <li><a href="{{url('upload')}}"><i class="fa fa-upload color-2"></i>Upload video</a></li>
                        @if(Auth::user()->authorization_level==0)
                            <li><a href="{{URL::to('user')}}"><i class="fa fa-users"></i>Pengguna</a></li>
						    <li><a href="{{URL::to('category')}}"><i class="fa fa-files-o"></i>Kategori</a></li>
                            <li><a href="{{url('mapping-admin')}}"><i class="fa fa-caret-right"></i>Mapping Admin</a></li>
                        @endif
                        @if(Auth::user()->authorization_level==1)
                            <li class="color-1"><a href="{{url('mapping-super-user')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Mapping Super User</a></li>
							<li class="color-1"><a href="{{url('mapping-reviewer')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Mapping Reviewer</a></li>
							<li class="color-1"><a href="{{url('mapping-video-to-reviewer')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Mapping Video ke Reviewer</a></li>
                        @endif
                        @if(Auth::user()->authorization_level==2)
                            <li class="color-1"><a href="{{url('video-verifikasi')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Verifikasi Video</a></li>
                        @endif
                        @if(Auth::user()->authorization_level==3)
                            <li class="color-1"><a href="{{url('review-video')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Review Video</a></li>
                        @endif
                    @endif
                    @php
                        $cat=App\Model\Category::orderBy('name')->get();
                        foreach($cat as $k => $v)
                        {
                            $first_letter = substr($v->name,0,1);
                            echo '<li class="color-1" style="width:100% !important;"><a href="'.route('video.bycategory', $v->slug).'"><span data-letters="'.$first_letter.'">'.$v->name.'</span></a></li>';
                        }
                    @endphp
                    </ul>
                </div><!-- // col-md-14 -->
              </div><!-- // row -->
          </div><!-- // container-full -->
      </div>