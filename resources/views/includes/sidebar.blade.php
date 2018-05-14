		
		{{--  <div class="col-md-2 no-padding-left no-padding-right hidden-sm hidden-xs" >  --}}
        	<div class="left-sidebar" alt="menu-sidebar">
            	<div>
            	<ul class="menu-sidebar" style="border-bottom:1px solid #dddddd;">
					<li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i>Home</a></li>
					@if(Auth::check())
						<li><a href="{{URL::to('data-video')}}"><i class="fa fa-youtube-play"></i>Video Saya</a></li>	
					@endif
                	<li><a href="{{URL::to('trending')}}"><i class="fa fa-star"></i>Video Favorit</a></li>
				</ul>
				@if(Auth::check())
					@if(Auth::user()->authorization_level==0)
					<ul class="menu-sidebar" style="border-bottom:1px solid #dddddd;">
						<li><a href="{{URL::to('user')}}"><i class="fa fa-users"></i>Pengguna</a></li>
						<li><a href="{{URL::to('category')}}"><i class="fa fa-files-o"></i>Kategori</a></li>
						<li><a href="{{url('upload')}}"><i class="fa fa-upload color-2"></i>Upload video</a></li>
						<li><a href="{{url('instrumen')}}"><i class="fa fa-file color-2"></i>Instrumen Penilaian</a></li>
						<li><a href="{{url('fasilitasi')}}"><i class="fa fa-cubes color-2"></i>Kegiatan Fasilitasi </a></li>
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
										<li class="color-1"><a href="{{url('mapping-admin')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Mapping Admin</a></li>
										{{-- <li class="color-1"><a href="{{url('mapping-fasilitasi')}}" style="padding:0px !important"><i class="fa fa-caret-right"></i>Mapping PIC Fasilitasi</a></li> --}}
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
							<li><a href="{{URL::to('topik-materi')}}"><i class="fa fa-files-o"></i>Topik Materi</a></li>
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
								<li class="color-1"><a href="{{url('mapping-super-user')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Mapping Super User</a>
								<li class="color-1"><a href="{{url('mapping-reviewer')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Mapping Reviewer</a>
								<li class="color-1"><a href="{{url('mapping-video-to-reviewer')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Mapping Video ke Reviewer</a>
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
								<li class="color-1"><a href="{{url('video-verifikasi')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Verifikasi Video</a></li>
								
							</ul>
						</ul>
					</ul>
					@elseif(Auth::user()->authorization_level==3)
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
								<li class="color-1"><a href="{{url('review-video')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Review Video</a></li>
								
							</ul>
						</ul>
					</ul>
					@endif

					<!-- PIC Fasilitas -->

					@php
						$fas=App\Model\MappingFasilitasi::where('user_id','=',Auth::user()->id)->get();
					@endphp
					@if (count($fas)!=0)
						<ul class="menu-sidebar" style="border-bottom:1px solid #dddddd;">
							<ul class="accordion" id="accordion-fasilitasi">
								<li class="a-panel">
									<div class="row">
										<a data-toggle="collapse" data-parent="#accordion-fasilitasi" href="#fasilitasi">
											<div class="col-lg-9 col-md-9">
												<i class="fa fa-cogs"></i>Kegiatan Fasilitasi
											</div>
											<div class="col-lg-1 col-md-1">
												<i class="fa fa-toggle-down"></i>
											</div>
											
										</a>
									</div>
								</li>
								<ul id="fasilitasi" class="collapse" style="margin-left:10px !important;padding-top:10 !important;">
									<li class="color-1"><a href="{{url('menu-aktivasi')}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>Menu Aktiviasi</a></li>
									
								</ul>
							</ul>
						</ul>
					@endif
					<!-- End PIC Fasilitas -->
					<!-- Peserta Fasilitas -->
					@php
						$pes_fas=App\Model\PesertaFasilitasi::with('fasilitasi')->where('user_id','=',Auth::user()->id)->get();

						$kegiatan=App\Model\KegiatanFasilitasi::with('provinsi')->get();
						$keg=array();
						foreach($kegiatan as $k =>$v)
						{
							$keg[$v->id]=$v;
						}
					@endphp
					@if (count($pes_fas)!=0)
						<ul class="menu-sidebar" style="border-bottom:1px solid #dddddd;">
							<ul class="accordion" id="accordion-setting-peserta">
								<li class="a-panel">
									<div class="row">
										<a data-toggle="collapse" data-parent="#accordion-setting-peserta" href="#linkawalpeserta">
											<div class="col-lg-9 col-md-9">
												<i class="fa fa-cogs"></i>Peserta Fasilitasi
											</div>
											<div class="col-lg-1 col-md-1">
												<i class="fa fa-toggle-down"></i>
											</div>
											
										</a>
									</div>
								</li>
								<ul id="linkawalpeserta" class="collapse" style="margin-left:10px !important;padding-top:10 !important;">
									@foreach ($pes_fas as $item)
										@if (isset($keg[$item->fasilitasi_id]))
											<li class="color-1"><a href="{{url('kegiatan-fasilitasi/'.$item->fasilitasi_id)}}" style="padding:10px 0px 5px !important"><i class="fa fa-caret-right"></i>{{$keg[$item->fasilitasi_id]->provinsi->name}} : {{$keg[$item->fasilitasi_id]->nama_fasilitasi}}</a></li>	
										@endif
										
									@endforeach
									
								</ul>
							</ul>
						</ul>
					@endif
					<!-- EndPeserta Fasilitas -->
					<!-- Saung -->
					<ul class="menu-sidebar" style="border-bottom:1px solid #dddddd;">
						<ul class="accordion" id="accordion-saung">
								<li class="a-panel">
									<div class="row">
										<a data-toggle="collapse" data-parent="#accordion-saung" href="#linksaung">
											<div class="col-lg-9 col-md-9">
												<i class="fa fa-files-o"></i>Saung Diskusi
											</div>
											<div class="col-lg-1 col-md-1">
												<i class="fa fa-toggle-down"></i>
											</div>
											
										</a>
									</div>
								</li>
								<ul id="linksaung" class="collapse" style="margin-left:10px !important;padding-top:10 !important;">
								@php
									$saung=App\Model\Saung::with('video')->where('created_user_id','=',Auth::user()->id)->get();
								@endphp
									@foreach ($saung as $item)
										<li class="color-1"><a href="{{url('buka-saung/'.$item->video->slug)}}" style="padding:0 0px 5px !important"><i class="fa fa-caret-right"></i>{{$item->video->title}}</a></li>	
										
									@endforeach
								
								@php
									$pes_saung=App\Model\SaungPivot::with('saung')->with('user')->where('user_id','=',Auth::user()->id)->get();
								@endphp
									@foreach ($pes_saung as $item)
										<li class="color-1"><a href="{{url('buka-saung/'.$item->saung->video->slug)}}" style="padding:0 0px 5px !important"><i class="fa fa-caret-right"></i>{{$item->saung->video->title}}</a></li>	
										
									@endforeach
									
								</ul>
							</ul>
						</ul>
					<!-- EndSaung -->

				@endif
            	<ul class="menu-sidebar accordion " id="accordion1" style="margin-bottom:0px !important;">
					<li class="a-panel">
						<a data-toggle="collapse" data-parent="#accordion1" href="#firstLink" style="" class="">
							<div class="row">
								<div class="col-lg-9 col-md-9">
									KATEGORI
								</div>
								{{--  <div class="col-lg-1 col-md-1">
									<i class="fa fa-toggle-down"></i>
								</div>
								<div class="col-lg-2 col-md-2 pull-right">&nbsp;</div>  --}}
							</div>
						</a>
					</li>
					@php
						$cat=App\Model\Category::orderBy('name')->get();
						$x=0;
						if(Auth::check())
						{

							if(Auth::user()->level==0 || Auth::user()->level==1)
							{
								$collapse='collapse';
							}
							else {
								$collapse='';
							}
						}
						else {
							$collapse='';
						}
					@endphp
					<ul id="firstLink" class="{{$collapse}}" style="" >
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
							<a href="{{ route('video.bycategory', $v->slug) }}" style="padding:5px;"><span data-letters="{{$first_letter}}">{{$cat_name}}</span></a>
						</li>
					@endforeach
					</ul>
                </ul>
            	<!--<ul class="menu-sidebar">
					<li><a href="#"><i class="fa fa-gear"></i>Settings</a></li>
                	<li><a href="#"><i class="fa fa-question-circle"></i>Help</a></li>
                	<li><a href="#"><i class="fa fa-send-o"></i>Send feedback</a></li>
                </ul>-->
			</div><!-- // sidebar-stick -->
			<div class="text-center" style="padding-bottom:50px;">&copy; Copyright 2018<br> Pustekkom Kemdikbud RI

				<br>
				<br>
				<br>
			</div>
                
            </div><!-- // left-sidebar -->
        {{--  </div>  --}}
