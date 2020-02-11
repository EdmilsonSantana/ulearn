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

                    @php

                    $first_lecture = array_values($curriculum_sections)[0][0];
                    $route_course_content = url('course-enroll/'.$course->course_slug.'/'.SiteHelpers::encrypt_decrypt($first_lecture->lecture_quiz_id,true));
                    $route_course_checkout = route('course.checkout', $course->course_slug);

                    $btn_route = $is_subscribed ? $route_course_content : $route_course_checkout;
                    $btn_label = $is_subscribed ? 'Ir para o curso' : 'Inscreva-se agora';
                    @endphp

                    @include('admin/components/link',
                    ['link' => $btn_route, 'text' => $btn_label, 'icon' => false, 'large' => true])
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