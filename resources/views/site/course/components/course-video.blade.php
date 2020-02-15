@if(isset($video))
<div>
    @php
    $file_name = '/app/public/course/'.$video->course_id.'/'.$video->video_title.'.'.$video->video_type;
    @endphp

    <video-js controls id="{{ $id }}" class="video-js vjs-default-skin vjs-big-play-centered {{!$is_modal ? 'vjs-16-9' : ''}} " data-setup='{}'>
        <source src="{{ Storage::url($file_name) }}" type="video/mp4">
        Your browser doesn't support HTML5 video tag.
        <p class="vjs-no-js">
            Para ver este vídeo, ative o JavaScript e considere atualizar para um navegador Web que
            <a href="https://videojs.com/html5-video-support/" target="_blank">suporte vídeo HTML5</a>
        </p>
    </video-js>
</div>
@endif

@if(isset($is_modal) && $is_modal)
    <script type="text/javascript">
        window.addEventListener('load', function() {
            $(document).on('lity:close', function(event, instance) {
                var videoPlayer = videojs("{{ $id }}");
                videoPlayer.pause();
            });
        });
    </script>
@endif