<div>
    @if($course->overview)
    <h4 class="mt-4">Descrição</h4>
    <div class="course-description">
        {!! $course->overview !!}
    </div>
    @endif

    @include('site/course/components/course-curriculum', ['is_learning' => $is_learning])

    @include('site/course/components/course-reviews')
</div>