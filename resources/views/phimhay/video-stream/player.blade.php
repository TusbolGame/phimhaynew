<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player</title>
    <link rel="icon" type="image/png" href="{!! asset('public/favicon.ico') !!}">
    {{-- <link href="//vjs.zencdn.net/4.12/video-js.css" rel="stylesheet"> --}}
    <link href="{!! asset('public/videojs/videojs/video-js.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('public/videojs/videojs/videojs-resolution-switcher.css') !!}" rel="stylesheet">
    <script src="{!! asset('public/videojs/videojs/video.min.js') !!}"></script>
    <script src="{!! asset('public/videojs/videojs/videojs-resolution-switcher.js') !!}"></script>
</head>
<body>

    <video id="video" class="video-js vjs-default-skin vjs-big-play-centered"
           controls preload="auto">
        <source src="{!! route('videoStream.getVideoStream', $filename) !!}" type="video/mp4">
    </video>

    {{-- <script src="//vjs.zencdn.net/4.12/video.js"></script> --}}
    
<script type="text/javascript">
    videojs('video', {
        width: 640,
        height: 264,
        fluid: true,
        controls: true
    }, function(){
        var player = this;
        window.player = player
        // player.updateSrc([
        //     {
        //         src: '{!! route('videoStream.getVideoStream', $filename) !!}',
        //         type: 'video/mp4'
        //     },
        // ]);
    });
</script>
</body>
</html>