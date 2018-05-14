
        <div class="row">
                <div class="col-lg-1-dash col-md-1-dash col-sm-1-dash">&nbsp;</div>
                <div class="col-lg-10-dash col-md-10-dash col-sm-10-dash">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                {{$videos->links()}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       
                            @php
                            foreach($videos as $ixk => $vik)
                            {
                                $durasi='00:00';
                                if($vik->duration!='00:00:00')
                                    {
                                        if($vik->duration!=-1)
                                        {
                                            if(strtok($vik->duration,':')=='00')
                                            {
                                                $durasi=substr($vik->duration,3,5);
                                            }
                                            else
                                                $durasi=$vik->duration;
                                        }
                                        else if($vik->duration==0)
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
                                    $cover="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/image/".$vik->image_path;
                                    if(File::exists(public_path().'/uploadfiles/image/'.$vik->image_path))
                                    {
                                        $cv = 'uploadfiles/image/'.$vik->image_path;
                                        $cover = url($cv);
                                        $vv='uploadfiles/video/'.$vik->video_path;
                                        $vid=url($vv);
                                    }
                                    else
                                    {   
                                        //$handle=fopen($cover,'r');
                                        $vid="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/video/".$vik->video_path;
                                        $cover=$cover;
                                        // $fileExists = checkExternalFile($cover);
                                        // if($fileExists==200)
                                        // {
                                        //     $cover=$cover;
                                        // }
                                        // else
                                        // {
                                        //     $cv='assets/img/no-image-02.png';
                                        //     $cover=url($cv);
                                        // }
                                    }
                                    $mime = "video/mp4";
                                    $waktu=$vik->created_at->diffForHumans();
                                    $wkt=text_translate($waktu,'en','id');
                                    // dd($waktu);
                            @endphp
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 padding-left-right-3">
                                    <div class="video-item">
                                        <div class="thumb" style="background:url(assets/img/no-image-02.png);background-size:90% 100%;background-position:center;border:1px solid #ccc;">
                                            <div class="hover-efect"></div>
                                            <small class="time">{{$durasi}}</small>
                                            <a href="{{url('review', $vik->id)}}" onclick="addhit('{{$vik->id}}')"><img src="{{ $cover}}" alt="" style=""></a>
                                        </div>
                                        <!--<a href="{{route('watch', $vik->slug)}}">
                                            <div class="thumb" id="thumb" style="height:150px;background:url(assets/img/no-image-02.png);background-size:100% 100%;">
                                                <video id="example_video_{{$vik->id}}" class="video-js vjs-default-skin vjs-big-play-centered"
                                                    controls preload="auto" height="180">
                                                    <source src="{{$vid}}" type="{{$mime}}" />
                                                </video>
                                            </div>
                                        </a>-->
                                        <div class="video-info">
                                            <a href="{{url('review', $vik->id)}}" onclick="addhit('{{$vik->id}}')" class="title">{{$vik->title}}</a>
                                            <a class="channel-name" href="#">{!!$vik->approved_by !=0 || $vik->appreved_by!='' ? '<i class="fa fa-check-circle-o" data-toggle="tooltip" title="Sudah Di Verifikasi"></i>' : ''!!}</i>&nbsp;&nbsp;{{isset($vik->category->name) ? $vik->category->name : ''}}</a>
                                            <span class="views"><i class="fa fa-eye"></i>{{$vik->hit}} views </span>
                                            <span class="date"><i class="fa fa-clock-o"></i>{{$wkt}}</span>
                                        </div>
                                    </div>
                                </div>  
                            @php
                                }
                            
                            @endphp
                           
                    </div>
                    
                </div>
                <div class="col-lg-1-dash col-md-1-dash col-sm-1-dash">&nbsp;</div>
                
            
            </div>
