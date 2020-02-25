<div class="lecture_title">
    <p>{!! $lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->video_name !!}</p>
    <p>{!! $lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->duration !!}</p>
    <p><span class="cclickable vid_preview text-default" data-id="{!! $lecturequiz->lecture_quiz_id !!}"><i class="fa fa-play"></i>{!! Lang::get('curriculum.Video_Preview')!!}</span></p>
</div>

@include('instructor/course/components/lecture_buttons', ['media_type' => 'video'])

<div class="media_preview " id="video_preview{!! $lecturequiz->lecture_quiz_id !!}" data-lec-id="{!! $lecturequiz->lecture_quiz_id !!}">
    @if($lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->processed == 0)
    {!! Lang::get('curriculum.lecture_process') !!}
    @else
    <video class='video-js vjs-default-skin video_p_{!! $lecturequiz->lecture_quiz_id !!}' controls preload='auto' data-setup='{}'></video>
    <!-- <video class='video-js vjs-default-skin' controls preload='auto' data-setup='{}'><source src="{!! asset('/uploads/videos/'.$lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->video_title.'.mp4') !!}" type="video/mp4" id="videosource"><source src="{!! asset('/uploads/videos/'.$lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->video_title.'.webm') !!}" type="video/webm" id="videosource"><source src="{!! asset('/uploads/videos/'.$lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->video_title.'.ogv') !!}" type="video/ogg" id="videosource"></video> -->
    @endif
</div>