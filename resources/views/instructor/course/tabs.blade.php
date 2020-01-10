<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-info*') ? 'active' : '' }}" href="@if($course->id) {{ route('instructor.course.info.edit', $course->id) }} @else {{ route('instructor.course.info') }} @endif">Geral</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-image*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.course.image.edit', $course->id) }} @else {{ 'javascript:void();' }} @endif">Imagem</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-video*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.course.video.edit', $course->id) }} @else {{ 'javascript:void();' }} @endif">Vídeo</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-curriculum*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.course.curriculum.edit', $course->id) }} @else {{ 'javascript:void();' }} @endif">Currículo</a>
    </li>
</ul>