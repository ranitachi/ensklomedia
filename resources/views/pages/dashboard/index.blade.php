@extends('layouts.master')

@section('title')
    <title>Beranda - Ensiklomedia</title>
@endsection

@section('content')
    <div id="all-output" class="col-md-10">
        @foreach ($cat as $k => $v)
            <h1 class="new-video-title"><i class="fa fa-th-large"></i> {{$v->category}}</h1>
            <div class="row">
            @php
            if(isset($video[$v->id]))
            {
                $fourdata = array_slice($video[$v->id], 0, 4);
                foreach($fourdata as $ixk => $vik)
                {
            @endphp
                  <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="video-item">
                        <div class="thumb">
                        	<div class="hover-efect"></div>
                            <small class="time">10:53</small>
                            <a href="{{route('watch', $vik->slug)}}"><img src="{{ asset('assets/demo_img/v1.png')}}" alt=""></a>
                        </div>
                        <div class="video-info">
                            <a href="#" class="title">{{$vik->title}}</a>
                            <a class="channel-name" href="#">{{$v->category}}<span>
                            <i class="fa fa-check-circle"></i></span></a>
                            <span class="views"><i class="fa fa-eye"></i>{{$vik->hit}} views </span>
                            <span class="date"><i class="fa fa-clock-o"></i>5 months ago </span>
                        </div>
                    </div>
                </div>  
            @php
                }
            }
            @endphp
            </div>
        @endforeach


		</div>
@endsection