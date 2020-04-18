<div class="lecture_main_content_first_block1">

    <div class="lc_details imagetype-audio">

        <div class="d-flex">

            <div class="lecture_title">
                <p>{!! $file_title !!}</p>
                <span>{!! $duration !!}</span>
                <p><span class="cclickable aud_preview text-default" data-id="{!! $lecturequiz->lecture_quiz_id !!}"><i class="fa fa-play"></i> {!! Lang::get('curriculum.Audio_Preview')!!}</span></p>
            </div>

            @include('instructor/course/components/lecture_buttons', ['media_type' => 'audio'])

        </div>

        <div class="media_preview" id="audio_preview{!! $lecturequiz->lecture_quiz_id !!}">
            @if($processed == 0)
            {!! Lang::get('curriculum.lecture_process') !!}
            @else
            <audio controls>
                <source src="{{ Storage::url('app/public/course/'.$course_id.'/'.$file_name . '.' . $file_type) }}" type="audio/mpeg">{!! Lang::get('curriculum.browser_support')!!}</audio>
            @endif
        </div>
    </div>
</div>