<div class="lecture_main_content_first_block1">
    <div class="lc_details imagetype-text">
        <div class="lecture_title">
            <p>{!! Lang::get('curriculum.Text')!!}</p>
        </div>

        @include('instructor/course/components/lecture_buttons', ['media_type' => 'text'])

        <div class="clearfix"></div>
        <div class="lecture_contenttext" id="lecture_contenttext{!! $lecturequiz->lecture_quiz_id !!}">
            {!! $text !!}
        </div>
    </div>
</div>