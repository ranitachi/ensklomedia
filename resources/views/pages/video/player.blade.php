<link href="{{asset('css/videojs.css')}}" rel="stylesheet">
<link href="{{asset('css/videojs.endcard.css')}}" rel="stylesheet">
<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" height="500" widht="898">
    <source src="{{$vid}}" type="{{$mime}}" />
</video>
<script src="{{asset('js/videojs.js')}}"></script>
<script src='{{asset('js/videojs.endcard.js')}}'></script>