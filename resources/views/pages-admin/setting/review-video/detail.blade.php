@extends('layouts.master')

@section('title')
    <title>Lihat Video - Ensiklomedia</title>
    <link href="{{asset('css/videojs.css')}}" rel="stylesheet">
    <link href="{{asset('css/videojs.endcard.css')}}" rel="stylesheet">
    <style>
        .share-in {
            margin-top: 0px !important;
        }

        .custom-size {
            height: 150px;
            width: 100%;
        }

        .thumb {
            height: 150px;
            background: url("{{ asset('assets/img/no-image-02.png') }}");
            background-size: 95% 100%;
            background-position: center;
        }

        .reply {
            cursor: pointer;
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s;
        }
        
        .fade-enter, .fade-leave-to {
            opacity: 0;
        }

        div#example_video_1
        {
            width:100% !important;
        }
    </style>
@endsection

@section('content')
            <div class="row hidden-lg hidden-md">             
                <div class="col-md-12">
                    
                </div>
                <div class="col-xs-12 col-sm-12 no-padding-all">
                    <div class="row top-50" style="">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" style="margin-bottom:0px !important;margin-top:20px">
                                        <strong>Sukses!</strong> 
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                    </div>
                    <video id="example_video_mobile" class="video-js vjs-default-skin vjs-big-play-centered" autoplay controls preload="auto">
                        <source src="{{$vid}}" type="{{$mime}}" />
                    </video>
                    <h1 class="video-title title-watch">{{($id==-1 ? 'Video Tidak Tersedia' : ucwords(strtolower($video->title)))}}</h1>
                </div>
                
                <div class="col-xs-12 col-sm-12 no-padding-all" style="margin:0px !important">
                    <div id="watch" style="padding:0px !important;margin:0px !important;">
                        <div class="chanel-item" style="margin-bottom:0px !important;">
                        		
                        		<div class="chanel-info" style="margin:0px !important;line-height:16px !important;">
                                    <a class="title" href="#">Deksripsi</a>
                                    <br>
                        			<span class="subscribers" style="text-transform:capitalize !important" style="padding-top:10px;">{{($id==-1 ? 'Deskripsi Tidak Tersedia' : $video->desc)}}</span>
                        		</div>
                        		
                        </div>

                        <div class="video-share" style="padding:8px !important;margin:0px !important">
                            <ul class="like">
                                <li><a class="like" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;{{($id==-1 ? 0 : $video->hit)}} views</i></a></li>
                            </ul>
                            <ul class="social_link">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a class="youtube" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a class="google" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a class="rss" href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                            </ul><!-- // Social -->
                        </div>
                    </div>
                    <ul class="nav nav-tabs" style="margin-top:10px;">
                            <li class="active"><a data-toggle="tab" href="#home">Pesan Review</a></li>
                            <li><a data-toggle="tab" href="#menu1">Edit Form</a></li>
                            <li><a data-toggle="tab" href="#menu2">End Cards</a></li>
                            <li><a data-toggle="tab" href="#menu3">Penilaian</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <div id="app">
                                    <div id="comments" class="post-comments">
                                        <h3 class="post-box-title">Pesan Review</h3>

                                        <form id="upload-review" action="{{ url('upload-review',$video->id) }}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <textarea class="form-control" rows="8" id="Message" placeholder="Review" name="pesan"></textarea>
                                            <br>
                                            <button type="button" id="simpan_pesan" class="btn btn-success"><i class="fa fa-send"></i>&nbsp;Kirim Pesan Review</button>
                                            @if ($video->approved_by==0 || $video->approved_by=='')
                                            <button type="button" id="verifikasi_video" onclick="verifikasi()" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Verifikasi Video</button>
                                            @endif
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade" style="padding:10px;">
                                <form id="upload-video" action="{{ url('edit-video-reviewer',$video->id) }}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Judul Video</label>
                                            <input type="text" class="form-control" placeholder="Judul Video" name="title" value="{{$video->title}}">
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label>Kategori</label>
                                            <select name="category_id" class="form-control" data-placeholder="Kategori" onchange="mapel(this.value,'sm')">
                                                <option value=""></option>
                                                @foreach ($cat as $k => $v)
                                                    @if ($v->id==$video->category_id)
                                                        <option value="{{$v->id}}" selected="selected">{{$v->name}}</option>
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Mata Pelajaran</label>
                                            <div id="cmb_mapel_sm">
                                                <select name="id_mapel" class="form-control" data-placeholder="Mata Pelajaran" id="id_mapel_sm">
                                                    <option value=""></option>
                                                    @foreach ($mapel as $k => $v)
                                                        @if ($v->id==$video->id_mapel)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->title}}</option>
                                                        @else
                                                            <option value="{{$v->id}}">{{$v->title}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Tag Video</label>
                                            <input type="text" class="form-control" placeholder="Tag Video" name="tag" value="{{$video->tags}}">
                                        </div>
                                        <div class="col-md-12" style="margin-top:10px;">
                                            <label>Deskripsi</label>
                                            <textarea class="form-control" rows="4"  placeholder="Deskripsi" name="description">{{$video->desc}}</textarea>
                                        </div>
                                       
                                        <div class="col-md-6">&nbsp;</div>
                                        <div class="col-md-6">
                                            <br>
                                            <button type="submit" id="edit_save" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="menu2" class="tab-pane fade" style="padding:10px;">
                                <form id="endcards-video" action="{{ url('add-endcards-reviewer',$video->id) }}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   @php
                                    $t1=$t2=$t3=$t4=$t5=$l1=$l2=$l3=$l4=$l5='';
                                       if(count($endcards)!=0)
                                       {
                                           $t1=(isset($endcards['title'][0]) ? $endcards['title'][0] : '');
                                           $t2=(isset($endcards['title'][1]) ? $endcards['title'][1] : '');
                                           $t3=(isset($endcards['title'][2]) ? $endcards['title'][2] : '');
                                           $t4=(isset($endcards['title'][3]) ? $endcards['title'][3] : '');
                                           $t5=(isset($endcards['title'][4]) ? $endcards['title'][4] : '');

                                           $l1=(isset($endcards['link'][0]) ? $endcards['link'][0] : '');
                                           $l2=(isset($endcards['link'][1]) ? $endcards['link'][1] : '');
                                           $l3=(isset($endcards['link'][2]) ? $endcards['link'][2] : '');
                                           $l4=(isset($endcards['link'][3]) ? $endcards['link'][3] : '');
                                           $l5=(isset($endcards['link'][4]) ? $endcards['link'][4] : '');
                                       }
                                   @endphp
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Title 1</label>
                                            <input type="text" class="form-control" placeholder="Titel 1" name="title[]" value="{{$t1}}">
                                        </div>
                                            <div class="col-md-6">
                                            <label>Link 1</label>
                                            <input type="text" class="form-control" placeholder="Link 1" name="link[]" value="{{$l1}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Title 2</label>
                                            <input type="text" class="form-control" placeholder="Titel 2" name="title[]" value="{{$t2}}">
                                        </div>
                                            <div class="col-md-6">
                                            <label>Link 2</label>
                                            <input type="text" class="form-control" placeholder="Link 2" name="link[]" value="{{$l2}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Title 3</label>
                                            <input type="text" class="form-control" placeholder="Titel 3" name="title[]" value="{{$t3}}">
                                        </div>
                                            <div class="col-md-6">
                                            <label>Link 3</label>
                                            <input type="text" class="form-control" placeholder="Link 3" name="link[]" value="{{$l3}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Title 4</label>
                                            <input type="text" class="form-control" placeholder="Titel 4" name="title[]" value="{{$t4}}">
                                        </div>
                                            <div class="col-md-6">
                                            <label>Link 4</label>
                                            <input type="text" class="form-control" placeholder="Link 4" name="link[]" value="{{$l4}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Title 5</label>
                                            <input type="text" class="form-control" placeholder="Titel 5" name="title[]" value="{{$t5}}">
                                        </div>
                                            <div class="col-md-6">
                                            <label>Link 5</label>
                                            <input type="text" class="form-control" placeholder="Link 5" name="link[]" value="{{$l5}}">
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                            <button type="submit" id="endcard_save" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan End Cards</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="menu3" class="tab-pane fade" style="padding:10px;">
                                @include('pages-admin.setting.review-video.penilaian')
                            </div>
                        </div>    
                </div>
            </div>
            <div class="row">
                <!-- Watch -->
                
                <div class="col-md-8 hidden-sm hidden-xs">
                    <div class="row">
                        <div class="col-md-12">
                            @if (Session::has('message'))
                                    <div class="alert alert-success">
                                        <strong>Sukses!</strong> 
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                        </div>
                    </div>
                	<div id="watch" style="margin-top:10px !important;padding:5px !important;">

                        <!-- Video Player -->
                        <div class="video-code">
                            <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
                            controls preload="auto" height="400">
                            
                            <source src="{{$vid}}" type="{{$mime}}" />
                        </video>
                        <!--<iframe width="100%" height="415" src="https://www.youtube.com/embed/e452W2Kj-yg" frameborder="0" allowfullscreen></iframe>-->
                    </div><!-- // video-code -->
                    <h1 class="video-title title-watch">{{($id==-1 ? 'Video Tidak Tersedia' : ucwords(strtolower($video->title)))}}</h1>
                    
                        <div class="video-share">
                        	<ul class="like">
                            	<li><a class="like" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;{{($id==-1 ? 0 : $video->hit)}} views</a></li>
                                <li><a class="like" href="#"><i class="fa fa-user"></i>&nbsp;&nbsp;Kontributor : {{$video->user->profile->name}}</a></li>
                                <li><a class="like" href="#"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Upload : {{date('d-m-Y H:i:s',strtotime($video->created_at))}}</a></li>
                                @if ($video->approved_by!=0 || $video->approved_by!='')
                                    <li><a class="like" href="#" style="color:red"><i class="fa fa-check"></i>&nbsp;&nbsp;Sudah Di Review</a></li>
                                @endif
                            </ul>
                            {{--  <ul class="social_link">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a class="youtube" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a class="google" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a class="rss" href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                            </ul><!-- // Social -->  --}}
                        </div><!-- // video-share -->
                        <!-- // Video Player -->


						<!-- Chanels Item -->
                        	<div class="chanel-item">
                        		
                        		<div class="chanel-info">
                                    <a class="title" href="#">Kategori : {{$video->category->name}}</a>
                        			<a class="title" href="#">Deksripsi</a>
                        			<span class="subscribers" style="text-transform:capitalize !important">{{($id==-1 ? 'Deksripsi Tidak Tersedia' : $video->desc)}}</span>
                        		</div>
                        		
                        	</div>
                        <!-- // Chanels Item -->


                        <!-- Comments -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home_lg">Pesan Review</a></li>
                            <li><a data-toggle="tab" href="#menu1_lg">Edit Form</a></li>
                            <li><a data-toggle="tab" href="#menu2_lg">End Cards</a></li>
                            <li><a data-toggle="tab" href="#menu3_lg">Penilaian</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home_lg" class="tab-pane fade in active">
                                <div id="app">
                                    <div id="comments" class="post-comments">
                                        <h3 class="post-box-title">Pesan Review</h3>

                                        <form id="upload-review" action="{{ url('upload-review',$video->id) }}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <textarea class="form-control" rows="8" id="Message" placeholder="Review" name="pesan"></textarea>
                                            <br>
                                            <button type="button" id="simpan_pesan" class="btn btn-success"><i class="fa fa-send"></i>&nbsp;Kirim Pesan Review</button>
                                            @if ($video->approved_by==0 || $video->approved_by=='')
                                            <button type="button" id="verifikasi_video" onclick="verifikasi()" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Verifikasi Video</button>
                                            @endif
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div id="menu1_lg" class="tab-pane fade" style="padding:10px;">
                                <form id="upload-video" action="{{ url('edit-video-reviewer',$video->id) }}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Judul Video</label>
                                            <input type="text" class="form-control" placeholder="Judul Video" name="title" value="{{$video->title}}">
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label>Kategori</label>
                                            <select name="category_id" class="form-control" data-placeholder="Kategori"  onchange="mapel(this.value,'lg')">
                                                <option value=""></option>
                                                @foreach ($cat as $k => $v)
                                                    @if ($v->id==$video->category_id)
                                                        <option value="{{$v->id}}" selected="selected">{{$v->name}}</option>
                                                    @else
                                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Mata Pelajaran</label>
                                            <div id="cmb_mapel_lg">
                                                <select name="id_mapel" class="form-control" data-placeholder="Mata Pelajaran" id="id_mapel_lg">
                                                    <option value=""></option>
                                                    @foreach ($mapel as $k => $v)
                                                        @if ($v->id==$video->id_mapel)
                                                            <option value="{{$v->id}}" selected="selected">{{$v->title}}</option>
                                                        @else
                                                            <option value="{{$v->id}}">{{$v->title}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Tag Video</label>
                                            <input type="text" class="form-control" placeholder="Tag Video" name="tag" value="{{$video->tags}}">
                                        </div>
                                        <div class="col-md-12" style="margin-top:10px;">
                                            <label>Deskripsi</label>
                                            <textarea class="form-control" rows="4"  placeholder="Deskripsi" name="description">{{$video->desc}}</textarea>
                                        </div>
                                       
                                        <div class="col-md-6">&nbsp;</div>
                                        <div class="col-md-6">
                                            <br>
                                            <button type="submit" id="edit_save" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="menu2_lg" class="tab-pane fade" style="padding:10px;">
                                <form id="endcards-video" action="{{ url('add-endcards-reviewer',$video->id) }}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   @php
                                    $t1=$t2=$t3=$t4=$t5=$l1=$l2=$l3=$l4=$l5='';
                                       if(count($endcards)!=0)
                                       {
                                           $t1=(isset($endcards['title'][0]) ? $endcards['title'][0] : '');
                                           $t2=(isset($endcards['title'][1]) ? $endcards['title'][1] : '');
                                           $t3=(isset($endcards['title'][2]) ? $endcards['title'][2] : '');
                                           $t4=(isset($endcards['title'][3]) ? $endcards['title'][3] : '');
                                           $t5=(isset($endcards['title'][4]) ? $endcards['title'][4] : '');

                                           $l1=(isset($endcards['link'][0]) ? $endcards['link'][0] : '');
                                           $l2=(isset($endcards['link'][1]) ? $endcards['link'][1] : '');
                                           $l3=(isset($endcards['link'][2]) ? $endcards['link'][2] : '');
                                           $l4=(isset($endcards['link'][3]) ? $endcards['link'][3] : '');
                                           $l5=(isset($endcards['link'][4]) ? $endcards['link'][4] : '');
                                       }
                                   @endphp
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Title 1</label>
                                            <input type="text" class="form-control" placeholder="Titel 1" name="title[]" value="{{$t1}}">
                                        </div>
                                            <div class="col-md-6">
                                            <label>Link 1</label>
                                            <input type="text" class="form-control" placeholder="Link 1" name="link[]" value="{{$l1}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Title 2</label>
                                            <input type="text" class="form-control" placeholder="Titel 2" name="title[]" value="{{$t2}}">
                                        </div>
                                            <div class="col-md-6">
                                            <label>Link 2</label>
                                            <input type="text" class="form-control" placeholder="Link 2" name="link[]" value="{{$l2}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Title 3</label>
                                            <input type="text" class="form-control" placeholder="Titel 3" name="title[]" value="{{$t3}}">
                                        </div>
                                            <div class="col-md-6">
                                            <label>Link 3</label>
                                            <input type="text" class="form-control" placeholder="Link 3" name="link[]" value="{{$l3}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Title 4</label>
                                            <input type="text" class="form-control" placeholder="Titel 4" name="title[]" value="{{$t4}}">
                                        </div>
                                            <div class="col-md-6">
                                            <label>Link 4</label>
                                            <input type="text" class="form-control" placeholder="Link 4" name="link[]" value="{{$l4}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Title 5</label>
                                            <input type="text" class="form-control" placeholder="Titel 5" name="title[]" value="{{$t5}}">
                                        </div>
                                            <div class="col-md-6">
                                            <label>Link 5</label>
                                            <input type="text" class="form-control" placeholder="Link 5" name="link[]" value="{{$l5}}">
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                            <button type="submit" id="endcard_save" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan End Cards</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="menu3_lg" class="tab-pane fade" style="padding:10px;">
                            @include('pages-admin.setting.review-video.penilaian')
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- Related Posts-->
                <div class="col-md-4 col-sm-12 col-xs-12">
                	<div id="related-posts" style="padding:0px !important;margin:0px !important;">
                        @foreach ($relatedvideo as $related)
                            <!-- video item -->
                            <div class="related-video-item">
                                <div class="thumb">
                                    
                                    @php
                                        $cover = "http://ensiklomedia.kemdikbud.go.id/uploads/images/".$related->image_path;
                                        if (File::exists($related->image_path)) {
                                            $cover = url('uploadfiles/image/'.$related->image_path);
                                        }
                                        $durasi='00:00';
                                        if($related->duration!='00:00:00')
                                            {
                                                if($related->duration!=-1)
                                                {
                                                    if(strtok($related->duration,':')=='00')
                                                    {
                                                        $durasi=substr($related->duration,3,5);
                                                    }
                                                    else
                                                        $durasi=$related->duration;
                                                }
                                                else if($related->duration==0)
                                                {
                                                    $durasi="00:00";
                                                }
                                                else {
                                                    $durasi="00:00";
                                                }
                                            }
                                            else {
                                                
                                                $durasi="00:00";
                                            }
                                    @endphp
                                    <small class="time">{{$durasi}}</small>
                                    <a href="{{ url('review', $related->id) }}" onclick="addhit('{{$related->id}}')"><img class="custom-size" src="{{ $cover }}" alt=""></a>
                                </div>
                                <a href="{{ url('review', $related->id) }}" class="title">{{ $related->title }}</a>
                                <a class="channel-name" href="#">
                                    {{ isset($related->user->profile->channel_name) ? $related->user->profile->channel_name : 'No Channel Name' }}
                                    <span><i class="fa fa-check-circle"></i></span>
                                </a>
                            </div>
                            <!-- // video item -->
                        @endforeach
                        
                    </div>
                </div><!-- // col-md-4 -->
                <!-- // Related Posts -->
            </div><!-- // row -->
		
@endsection


@section('footscript')

    <script src="{{asset('js/videojs.js')}}"></script>
    <script src='{{asset('js/videojs.endcard.js')}}'></script>
    <script>
        //videojs(document.getElementById('example_video_1'), {}, function() {
            // This is functionally the same as the previous example.
        //});
        var widthvideo=$(document).width();
        var heightvideo=(parseInt(widthvideo) / 1.33);
        // alert(widthvideo);
        var video2 = videojs('example_video_mobile',{height: heightvideo, width: widthvideo});

        var video = videojs('example_video_1');
             
        function verifikasi()
        {
            var txt="<h2>Apakah anda Yakin untuk Verifikasi Video ini ?</h2>";
            $('#content-body').html(txt);
            $('#modal_default').modal('show');
            $('button#ok').click(function(){
                $('#upload-review').submit();
            });    
        }

        function mapel(val,j)
        {
            $('#cmb_mapel_'+j).load(APP_URL+'/combo-mapel/'+val);
            // alert(val+'--'+j);
        }
    </script>
    <style>
        div#example_video_1
        {
            width:100% !important;
        }
        div#example_video_mobile
        {
            width:100% !important;
            margin-top:5px !important;
        }
        
    </style>
@endsection