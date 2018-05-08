@extends('layouts.master')

@section('title')
    <title>Ensiklomedia</title>
     <link href="{{asset('css/videojs.css')}}" rel="stylesheet">
@endsection

@section('content')
    
        <div class="row margin-m-100">
            <div class="col-lg-12 col-md-12 col-cm-12">&nbsp;</div>
        </div>
        <div id="container-fluid">
            <div id="data-vid" style="width:100%%;margin:0 auto !important;text-align:left"></div>
        </div>
@endsection
@section('footscript')
    <script src="{{asset('js/videojs.js')}}"></script>
    <script>
        $(document).ready(function(){
            var width=$(window).width();
            // alert(width);
            ukuran(width);
            loaddata(width);
            // $( window ).resize(function() {
            //     var wdt=$( window ).width();
            //     // alert(wdt)
            //     loaddata(wdt);
            // });
        });
        function ukuran(lebar)
        {
            if(lebar>880)
            {
                // var k=((lebar-880)/lebar) * 100;
                // var t=880;
                // // alert(k);
                // $('#k').css({'width':k+'%','border':'1px solid #000;'});
                // $('#r').css({'width':k+'%','border':'1px solid #000;'});
                // $('#t').css('width',t+'px');
            }
        }
        //alert(width);
        /*$('video.video-js').each(function(a){
            var id=$(this).attr('id');
            //$('div#'+id).css({'width': width+'px !important'});
            videojs(document.getElementById(id), {
                    width: lebar, 
                    height: 150
                }, function() {
                    this.bigPlayButton.hide();
            });
            // This is functionally the same as the previous example.
        });*/
        function loaddata(width)
        {
            if(width>1024 && width<1284)
            {
                $('#data-vid').load(APP_URL+'/video-data/4');
            }
            else if(width>=1284)
            {
                $('#data-vid').load(APP_URL+'/video-data/5');
            }
            else
                $('#data-vid').load(APP_URL+'/video-data/4');
        }
        function addhit(id)
        {
            $.ajax({
                url : APP_URL+'/video-add-hit/'+id,
                success : function(a){
                }
            });
        }
    </script>
    <style>
        div#example_video_1
        {
            /*width:100% !important;*/
        }
    </style>
@endsection