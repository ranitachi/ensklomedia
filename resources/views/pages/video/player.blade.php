<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>

    <link href="{{asset('css/videojs.css')}}" rel="stylesheet">
</head>
<body>

    <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
           controls preload="auto" height="600" width="980">

        <source src="{{url($video)}}" type="{{$mime}}" />
    </video>

    <script src="{{asset('js/videojs.js')}}"></script>

    <script>
        videojs(document.getElementById('example_video_1'), {}, function() {
            // This is functionally the same as the previous example.
        });
    </script>
</body>
</html>