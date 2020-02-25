<div class="lecture_title">
    <p>{!! $lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->file_title !!}</p>
    <p>{!! $lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->duration !!}</p>
    <p><span class="cclickable aud_preview text-default" data-id="{!! $lecturequiz->lecture_quiz_id !!}"><i class="fa fa-play"></i> {!! Lang::get('curriculum.Audio_Preview')!!}</span></p>
</div>

@include('instructor/course/components/lecture_buttons', ['media_type' => 'audio'])

<div class="media_preview" id="audio_preview{!! $lecturequiz->lecture_quiz_id !!}">
    @if($lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->processed == 0)
    {!! Lang::get('curriculum.lecture_process') !!}
    @else
    <audio controls>
        <source src="{{ Storage::url('course/'.$course_id.'/'.$lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->file_name.'.mp3') }}" type="audio/mpeg">{!! Lang::get('curriculum.browser_support')!!}</audio>
    @endif
</div>