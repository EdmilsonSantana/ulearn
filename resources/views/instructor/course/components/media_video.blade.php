<div class="lecture_main_content_first_block1">
    <div class="lc_details imagetype-video">

        <div class="d-flex">

            <div class="lecture_title">
                <p>{!! $video->video_name !!}</p>
                <span>{!! $video->duration !!}</span>
                <p><span class="cclickable vid_preview text-default" data-id="{!! $lecturequiz->lecture_quiz_id !!}"><i class="fa fa-play"></i> {!! Lang::get('curriculum.Video_Preview')!!}</span></p>
            </div>

            @include('instructor/course/components/lecture_buttons', ['media_type' => 'video'])
        </div>
        <div class="media_preview " id="video_preview{!! $lecturequiz->lecture_quiz_id !!}" data-lec-id="{!! $lecturequiz->lecture_quiz_id !!}">

            @if($video->processed == 0)
            {!! Lang::get('curriculum.lecture_process') !!}
            @else
            @include('site/course/components/course-video', ['video_url' => SiteHelpers::getCourseVideoUrl($video), 'id' => 'video_p_' . $lecturequiz->lecture_quiz_id, 'is_modal' => false])
            @endif
        </div>
    </div>
</div>