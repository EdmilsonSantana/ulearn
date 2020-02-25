<div class="lecture_title">
    <p>{!! $lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->file_title !!}</p>
    @php $pdfpages = $lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id][0]->duration; @endphp
    <p>@if($pdfpages <= 1) {!! $pdfpage=$pdfpages.' Page' !!} @else {!! $pdfpage=$pdfpages.' Pages' !!} @endif</p> 
</div>
    
@include('instructor/course/components/lecture_buttons', ['media_type'=> 'file'])

