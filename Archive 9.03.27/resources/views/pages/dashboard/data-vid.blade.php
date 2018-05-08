            <div class="row">
                <div class="col-md-1-dash col-sm-1">&nbsp;</div>
                <div class="col-md-10-dash col-sm-10">
                    <center>
                        <div class="" style="text-align:left;">
                            {{--  <h1 class="new-video-title" style="padding-top:0px !important;padding-bottom:0px;">
                                <span data-letters="{{$first_letter}}"> {{$v->name}}</span></h1>  --}}
                                @php
                                // if(isset($video[$v->id]))
                                $img_dikaji='';
                                if(isset($video))
                                {
                                    // $fivedata = array_slice($video[$v->id], 0, $jlh);
                                    $no=1;
                                    foreach($video as $ixk => $vik)
                                    {
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
                                        $waktu=\Carbon\Carbon::parse($vik->created_at)->diffForHumans();
                                        $wkt=text_translate($waktu,'en','id');
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
                                        if(is_null($vik->approved_by))
                                        {
                                            $cv = 'assets/img/belum-dikaji.jpg';
                                            $cvr = url($cv);
                                            //$durasi='';
                                            $img_dikaji='1';
                                        }
                                        if(isset($vik->category->name))
                                            $kategori=$vik->category->name;
                                        else
                                            $kategori='';

                                        $nilai=getstar($vik->nilai_review);
                                @endphp
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 margin-left-right-2 col-custom hidden-sm hidden-xs">
                                        <div class="video-item">
                                            <div class="thumb" style="background:url(assets/img/no-image-02.png);background-size:90% 100%;background-position:center;border:1px solid #ccc;">
                                               
                                                    <div class="hover-efect"></div>
                                                    <small class="time">{{$durasi}}</small>
                                                <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')"><img src="{{ $cover}}" alt="" style="height:118px;width:210px">
                                                
                                                </a>
                                            </div>
                                            
                                            <div class="video-info">

                                                @if(is_null($vik->approved_by))
                                                    {!!rating(0)!!}
                                                @else
                                                    {!!rating($nilai)!!}
                                                @endif
                                                <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')" class="title">{{(($vik->title))}}</a>
                                                <a class="channel-name" href="#">{{$kategori}}</a>
                                                    <span class="views"><i class="fa fa-eye"></i>{{$vik->hit}} views </span>
                                                    <span class="date"><i class="fa fa-clock-o"></i>{{trim($wkt)}}</span>
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    <div class="col-sm-12 col-xs-12 padding-left-right-3 hidden-lg hidden-md">
                                        <div class="video-item">
                                            <div class="thumb" style="background:url(assets/img/no-image-02.png);background-size:90% 100%;background-position:center;border:1px solid #ccc;">
                                                
                                                <div class="hover-efect"></div>
                                                
                                            @if($durasi!='')
                                                    <small class="time">{{$durasi}}</small>
                                                @endif
                                                <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')"><img src="{{ $cover}}" alt="" style="width:100%"></a>
                                            </div>
                                            
                                            <div class="video-info">
                                                {!!rating(0)!!}
                                                <a href="{{route('watch', $vik->slug)}}" onclick="addhit('{{$vik->id}}')" class="title">{{(($vik->title))}}</a>
                                                <a class="channel-name" href="#">{{$kategori}}</a>
                                                <span class="views"><i class="fa fa-eye"></i>{{$vik->hit}} views </span>
                                                <span class="date"><i class="fa fa-clock-o"></i>{{$wkt}}</span>
                                            </div>
                                        </div>
                                    </div>  
                                @php
                                    $no++;
                                    }
                                }
                                @endphp
                            
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-1-dash col-sm-1">&nbsp;</div>

            </div>
       