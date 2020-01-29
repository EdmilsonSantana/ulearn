<div>
    <section class="course-feature">
        <div class="course-preview">
            <div class="bg-gradient"></div>
            @if(isset($video))
                <a href="#course-video-preview" data-lity>
                    <div class="play-button"></div>
                </a>
            @endif
            <div class="course-image">
                <img src="@if(Storage::exists($course->course_image)){{ Storage::url($course->course_image) }}@else{{ asset('backend/assets/images/course_detail.jpg') }}@endif">
            </div>
        </div>
        <div class="course-feature-content">
            <div class="container">
                <div class="d-flex flex-column">
                    <div class="course-pricing">
                        {{ $course->price ? 'R$'.$course->price : 'Gratuito' }}
                    </div>
                    @include('admin/components/link',
                    ['link' => route('course.checkout', $course->course_slug), 'text' => 'Inscreva-se agora', 'icon' => false, 'large' => true])
                </div>
            </div>
            <ul class="list-unstyled cf-pricing-li">
                <li><i class="far fa-clock"></i>Duração: {{ $course->duration ? $course->duration : '-' }}</li>
                <li><i class="fas fa-bullhorn"></i>Atividades: {{ $lectures_count }}</li>
                <li><i class="far fa-play-circle"></i>Videos: {{ $videos_count }}</li>
            </ul>
        </div>
    </section>

    <div class="lity-hide">
        @include('site/course/components/course-video', ['id' => 'course-video-preview'])
    </div>
</div>