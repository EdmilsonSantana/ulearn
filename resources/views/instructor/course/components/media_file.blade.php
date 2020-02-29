<div class="lecture_main_content_first_block1">
    <div class="lc_details imagetype-file">

        <div class="lecture_title">
            <p>{!! $file_title !!}</p>

            <p>@if($pdfpages <= 1) {!! $pdfpage=$pdfpages.' Página' !!} @else {!! $pdfpage=$pdfpages.' Páginas' !!} @endif</p> 
        </div>
            
        @include('instructor/course/components/lecture_buttons', ['media_type'=> 'file'])

    </div>
</div>