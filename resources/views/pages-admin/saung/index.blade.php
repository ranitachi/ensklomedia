@extends('layouts.master')

@section('title')
    <title>Saung : {{ucwords(strtolower($video->title))}} - Ensiklomedia</title>
    <link href="{{asset('css/videojs.css')}}" rel="stylesheet">
    <link href="{{asset('css/chat-box.css')}}" rel="stylesheet">
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
            <div class="row margin-m-100"></div>
            <div class="row hidden-lg hidden-md">
                <div class="col-xs-12 col-sm-12 no-padding-all margin-m-50">
                    <video class="hidden-lg hidden-md" preload="" controls="" style="width:100%;height:auto;">
                        <source src="{{$vid}}"/>
                    </video>
                    {{--  <video id="playvid" style="width:100%;height:auto;" preload="" controls="">
                        <source src="https://www.kemdikbud.go.id/main/uploads/default/videos/PPK.mp4">
                    </video>  --}}
                    {{--  <iframe src="https://www.kemdikbud.go.id/main/uploads/default/videos/PPK.mp4" style="width:100%;height:330px;border:0px "></iframe>  --}}
                </div>
                
                <div class="col-xs-12 col-sm-12 no-padding-all" style="margin:0px !important">
                <h1 class="video-title title-watch">{{($id==-1 ? 'Video Tidak Tersedia' : ucwords(strtolower($video->title)))}} {!!(is_null($video->approved_by) ? rating(0) : '')!!}</h1>
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
                            
                        </div>
                    </div>
                        
                </div>
            </div>
            <div class="row">
            	<!-- Watch -->
                {{--  <div class="col-md-1 hidden-sm hidden-xs">&nbsp;</div>  --}}
                <div class="col-md-8 hidden-sm hidden-xs">
                	<div id="watch" style="padding-right:0px;">
                        @php
                            $cover="http://ensiklomedia.kemdikbud.go.id/uploads/images/".$video->image_path;
                            if(File::exists(public_path().'/uploadfiles/image/'.$video->image_path))
                            {
                                $cv = 'uploadfiles/image/'.$video->image_path;
                                $cover = url($cv);
                            }

                                    if(is_null($video->approved_by))
                                    {
                                        $cv = 'assets/img/belum-dikaji.jpg';
                                        // $cover = url($cv);
                                        $durasi='';
                                    }
                        @endphp
                        <!-- Video Player -->
                        <div class="video-code">
                            <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
                            controls preload="auto" height="400" poster="{{$cover}}">
                            
                            <source src="{{$vid}}" type="{{$mime}}" />
                        </video>
                        <!--<iframe width="100%" height="415" src="https://www.youtube.com/embed/e452W2Kj-yg" frameborder="0" allowfullscreen></iframe>-->
                        </div><!-- // video-code -->
                        <h1 class="video-title title-watch" style="margin-bottom:5px;">
                            
                            {{($id==-1 ? 'Video Tidak Tersedia' : ucwords(strtolower($video->title)))}} 
                        </h1>

                        <div class="video-share" style="margin:0px">
                            <div class="row">
                                <div class="col-md-5">

                                    <ul class="like">
                                            <li><a class="like" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;{{($id==-1 ? 0 : $video->hit)}} views</i></a></li>
                                            @php
                                        $waktu=\Carbon\Carbon::parse($video->created_at)->diffForHumans();
                                        $wkt=text_translate($waktu,'en','id');
                                        @endphp
                                    <li><a class="like" href="#"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{date('d-m-Y',strtotime($video->created_at))}} :: {{($id==-1 ? 0 : $wkt)}}</i></a></li>
                                </ul>
                            </div>
                            <div class="col-md-7 text-right">
                                @if (count($pesertasaung)!=0 )
                                    @foreach ($pesertasaung as $item)
                                        <img src="{{asset('assets/img/user.png')}}" class="saung-img" data-toggle="tooltip" title="{{$profile[$item->user_id]->name}}">
                                    @endforeach
                                @else
                                    <i>Peserta Saung Belum Ada</i>
                                @endif
                                {{-- <img src="{{asset('assets/img/user.png')}}" class="saung-img" data-toggle="tooltip" title="Peserta Saung">
                                <img src="{{asset('assets/img/user.png')}}" class="saung-img" data-toggle="tooltip" title="Peserta Saung">
                                <img src="{{asset('assets/img/user.png')}}" class="saung-img" data-toggle="tooltip" title="Peserta Saung">
                                <img src="{{asset('assets/img/user.png')}}" class="saung-img" data-toggle="tooltip" title="Peserta Saung">
                                <img src="{{asset('assets/img/user.png')}}" class="saung-img" data-toggle="tooltip" title="Peserta Saung">
                                <img src="{{asset('assets/img/user.png')}}" class="saung-img" data-toggle="tooltip" title="Peserta Saung">
                                <img src="{{asset('assets/img/user.png')}}" class="saung-img gray" data-toggle="tooltip">
                                <img src="{{asset('assets/img/user.png')}}" class="saung-img gray" data-toggle="tooltip">
                                <img src="{{asset('assets/img/user.png')}}" class="saung-img gray" data-toggle="tooltip">
                                <img src="{{asset('assets/img/user.png')}}" class="saung-img gray" data-toggle="tooltip"> --}}
                                <img src="{{asset('assets/img/add-user.png')}}" class="saung-img" data-toggle="tooltip" title="Klik Untuk Mengundang Peserta" style="margin-left:10px;padding-top:5px;">
                                
                            </div>
                        </div>
                            
                        </div><!-- // video-share -->
                        <!-- // Video Player -->


						<!-- Chanels Item -->
                        	<div class="chanel-item" style="margin-top:5px">
                        		
                        		<div class="chanel-info">
                                    <div id="penjelasan-detail" style="">
                                        <a class="title" href="#">Deksripsi</a>
                        			    <span class="subscribers" style="text-transform:capitalize !important">{{($id==-1 ? 'Deksripsi Tidak Tersedia' : $video->desc)}}</span>
                        		    </div>
                        		</div>
                        		
                        	</div>
                        <!-- // Chanels Item -->
                        
                       
                    </div>
                </div>

                <!-- Related Posts-->
                <div class="col-md-4 col-sm-12 col-xs-12" style="padding-left:0px;margin-left:0px">
                    <div class="teacher-img ">
                        <img src="{{asset('assets/img/teacher.png')}}" class="bottom10">
                        <div class="row">
                            <div class="col-md-3">Moderator</div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">{{isset($saung->user->email) ? $profile[$saung->created_user_id]->name : 'N/A'}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Reviewer</div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">{{isset($saung->reviewer->email) ? ($profile[$saung->reviewer_id]->name=='' ? $saung->reviewer->email : $profile[$saung->reviewer_id]->name) : 'N/A'}}</div>
                        </div>
                        @if (count($saung)!=0)
                            @if ($saung->flag==1)
                                @if (Auth::user()->id==$saung->created_user_id)
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <button class="btn btn-xs btn-warning pull-right" onclick="tutupsaung('{{$saung->id}}','{{$video->slug}}')"><i class="fa fa-close"></i> Tutup Saung</button>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>
                    @if (count($saung)!=0)
                        @if ($saung->flag==1)
                        <div class="rpp">
                            <div class="row">
                                    <div class="col-md-12 text-right"><h2>Materi Pendukung</h2></div>
                                    <div id="topik-turunan"></div>
                                    @if (Auth::user()->id==$saung->created_user_id)
                                        
                                        <center>
                                            <button class="btn btn-xs btn-primary" onclick="tambahtopik('{{$video->id}}','-1','{{Auth::user()->id}}')">
                                                    <i class="fa fa-plus-square"></i> Tambah Materi Pendukung
                                            </button>
                                        </center>
                                    @endif
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-12">
                                <button class="btn btn-md btn-danger col-md-12">Topik Tantangan</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top:3px;">
                            <div class="col-md-6">
                                <button class="btn btn-md btn-primary col-md-12">Latihan</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-md btn-success col-md-12" id="chat"><i class="fa fa-comments-o"></i> Chat Saung</button>
                            </div>
                        </div>
                     @endif
                    @endif
                </div><!-- // col-md-4 -->
                <!-- // Related Posts -->
            </div><!-- // row -->
		
@endsection
<div id="wrapper">
    <div id="menu">
        <div class="row">
            <div class="col-md-12 welcome text-right">
                <span id="maximize">[ <i class="fa fa-expand" style="cursor:pointer"  data-toggle="tooltip" title="Full Screen"></i> ]</span>
                <span id="normal" style="display:none">[ <i class="fa fa-compress" style="cursor:pointer;"  data-toggle="tooltip" title="Normal Screen" data-placement="bottom"></i> ]</span>
                <span id="minimize" >[ <i class="fa fa-minus" style="cursor:pointer" data-toggle="tooltip" title="Minimize"></i> ]</span>
            </div>
        </div>
        <p class="welcome">Anda mengobrol sebagai <b>{{$profile[Auth::user()->id]->name}}</b></p>
        {{-- <p class="logout"><a id="exit" href="#">Tinggalkan Chat</a></p> --}}
        <div style="clear:both"></div>
    </div>  
    <div id="isichat"></div> 
    <form name="message" action="" id="chat-sent" class="padding-margin-0">
        <center>
            <input name="usermsg" type="text" id="usermsg" size="63" />
            <input name="submitmsg" type="button"  id="submitmsg" value="Kirim" />
        </center>
    </form>
</div>
@php
$endcards=array();
if($id!=-1)
{
    $ec=App\Model\Endcards::where('video_id','=',$video->id)->get();
    foreach($ec as $k => $v)
    {
        $endcards[]=$v;
    }
}
// $ecard=str_replace(array('[',']'),'',json_encode($endcards));
$ecard=json_encode($endcards);
$saungid= count($saung)!=0 ? $saung->id : 0;
@endphp
<div id="form-topik"></div>
@section('footscript')

    <script src="{{asset('js/videojs.js')}}"></script>
    <script src='{{asset('js/videojs.endcard.js')}}'></script>
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script>
    <script>
        function loadchat()
        {
            $('#isichat').load(APP_URL+'/chat-data/{{$saung->id}}');
        }
         $(document).ready(function(){
            loadchat();
            setInterval(function(){
                loadchat();
            },900);

            $('#submitmsg').click(function(){
                var t_url = APP_URL+'/chat/{{$saung->id}}';
                var t_method = 'POST';
                $.ajax({
                    url : t_url,
                    type : t_method,
                    dataType: 'json',
                    cache: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: $('#chat-sent').serialize()
                }).done(function(data){
                    $('#usermsg').val('');
                    loadchat();
                }).fail(function(data){
                    
                });
            });

            var pesan='{!! Session::get("status") !!}';
            if(pesan!='')
            {
                $('#content-body-ok').html('<h2 style="color:black">'+pesan+'</h2>');
                $('#modal_ok').modal('show');
            }

            var status_saung='{{count($saung)!=0 ? $saung->flag : 0}}';
            if(status_saung==0)
            {
                // $('button#close-ok').hide();
                $('#content-body-ok').html('<h1>Saung Ini Sudah Tidak Aktif Lagi, Silahkan Pilih Saung Yang Lain</h1>');
                $('.close').css('display','none');
                $('#modal_ok').modal({backdrop: 'static', keyboard: false});
                $('#tombol-ok').click(function(){
                    location.href=APP_URL+'/watch/{{$video->slug}}';
                });
            }
            
            loadtopik('{{$video->id}}','-1','{{Auth::user()->id}}');

            $('#wrapper').hide();
            $('#minimize').click(function(){
                $('#wrapper').slideUp('slow');
            });
            $('#chat').click(function(){
                $('#wrapper').slideDown('slow');
            });
            $('#maximize').click(function(){
                $('#normal').show();
                $('#maximize').hide();
                $('#minimize').hide();
                $('#wrapper').css({'width':'100%','top':'0','z-index':'200000'});
                $('#chatbox').css({'height':'70%'});
            });
            $('#normal').click(function(){
                $('#normal').hide();
                $('#maximize').show();
                $('#minimize').show();
                $('#wrapper').css({'width':'30%','top':'unset','z-index':'10000'});
                $('#chatbox').css({'height':'200px'});
            });

        });
            $(document).keyup(function(e) {
                if (e.keyCode == 27) { // escape key maps to keycode `27`
                    $('#normal').hide();
                    $('#maximize').show();
                    $('#minimize').show();
                    $('#wrapper').css({'width':'30%','top':'unset','z-index':'10000'});
                    $('#chatbox').css({'height':'200px'});  
                }
            });
        var widthvideo=$(document).width();
        var heightvideo=(parseInt(widthvideo) / 1.33);
        var ecard='{{$ecard}}';

        var en_c=JSON.parse(ecard.replace(/&quot;/g,'"'));

        // alert(en_c.length);
        var tinggi=(100 / en_c.length);
        // if(widthvideo<600)
        //     var video2 = videojs('example_video_mobile',{controls:true,height: heightvideo, width: widthvideo,autoplay: true});
            
        var video = videojs('example_video_1');
        var ls=[];
        
        function getRelatedContent(callback) 
        {
            var list = [];
            for(var x=0;x<en_c.length;x++)
            {
                var rel_content = document.createElement('div');
                var a = document.createElement('a');
                var p = document.createElement('p');
                p.innerHTML = en_c[x].title;
                a.href=en_c[x].link;
                a.appendChild(p);
                rel_content.appendChild(a);
                list.push(rel_content);
            }
            // list.push(rel_content_2);

            setTimeout(function(){
                callback(list);
            }, 0);
        }

        function getNextVid(callback) {
            // setTimeout(function(){
            //     callback(next_video);
            // }, 0);
        }

        if(widthvideo<600)
        {
            // video2.endcard({
            //     getRelatedContent: getRelatedContent,
            // // getNextVid: getNextVid, //------------------------------ uncomment this to get autoplaying video
            //     count: 8
            // });

        }
        else
        {
            video.endcard({
                getRelatedContent: getRelatedContent,
            // getNextVid: getNextVid, //------------------------------ uncomment this to get autoplaying video
                count: 8
            });

        }
        function tutupsaung(idsaung,slug)
        {
            //$('.modal-dialog').css({'width': '90% !important'});
            $('#content-body').html('<h1 style="color:#000">Anda yakin ingin Menutup Saung ini ?</h1>');
            $('#modal_default').modal('show');
            $('#ok').click(function(){
                location.href=APP_URL+'/tutup-saung/'+idsaung+'/'+slug;
            });
        }
        function penjelasan(id)
        {
            $('#penjelasan-detail').load(APP_URL+'/topik-turunan-penjelasan/'+id);
        }
        function loadtopik(video_id,saung_id,user_id)
        {
            $('#topik-turunan').load(APP_URL+'/topik-turunan-data/'+video_id+'/'+saung_id+'/'+user_id);
        }
        function tambahtopik(idvid,idtopik,user_id)
        {
            $('#form-topik').load(APP_URL+'/topik-turunan-form/'+idvid+'/'+idtopik+'/'+user_id+'/{{$saungid}}',function(){
                $('#lfm').filemanager('image', {prefix: APP_URL+'/laravel-filemanager'});
                var options = {
                    filebrowserImageBrowseUrl: APP_URL+'/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: APP_URL+'/laravel-filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: APP_URL+'/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: APP_URL+	'/laravel-filemanager/upload?type=Files&_token='
                };
                CKEDITOR.replace('penjelasan', options);

                $('.modal-title-lg').text('Form Topik Turunan');
                $('#modal_besar').modal('show');
                $('#ok-lg').click(function(){
                    var topik=$('#topik').val();
                    var content = CKEDITOR.instances['penjelasan'].getData();
                    if(topik=='')
                    {
                        var txt = "Topik Turunan Harus Di Isi";
                        $.notify(txt,{
                            elementPosition: 'bottom right',
                            globalPosition: 'buttom right',
                            className : 'error',
                            z_index : 1500000
                        });
                    }
                    else if(content=='')
                    {
                        var txt = "Penjelasan Topik Turunan Harus Di Isi";
                        $.notify(txt,{
                            elementPosition: 'bottom right',
                            globalPosition: 'buttom right',
                            className : 'error',
                            z_index : 1500000
                        });
                    }
                    else
                    {
                        $('#form-topik-turunan').submit();
                    }
                });
            });
            
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
        }
        #modal_besar > .modal-dialog {
            width: 90%;
            height: 100%;
            margin-top:5px;
            /* margin: 0;
            padding: 0; */
        }
        .modal{
            z-index:10000 !important;
        }
        .notifyjs-corner
        {
            z-index:15000 !important;
        }
        #topik-turunan
        {
            padding:10px;
            font-size: 14px;
            font-weight: 600;
            margin-left:0px;
            color:darkblue;
            cursor:pointer;
        }
        .list-topik li
        {
            list-style:none;
            border-bottom:1px dotted #888;

        }
        #penjelasan-detail
        {
            height: 350px;
            width:100%;
            overflow-y: scroll;  
        }
        #penjelasan-detail p
        {
            color:#000 !important;
            text-transform: capitalize;
        }
        .chanel-item .chanel-info
        {
            width:100% !important;
        }
    </style>
@endsection
