@extends('layouts.frontend.index')
@section('content')
<!-- content start -->
<div class="container-fluid p-0">
    <!-- banner start -->
    <div class="subpage-slide-blue">
        <div class="container">
            <h1>Meus cursos</h1>
        </div>
    </div>
    <!-- banner end -->

    <!-- course list start -->
    <div class="courses-panel">
        <div class="container" id="my-courses">
            <div class="row">
                @if(count($courses)> 0 )
                @foreach($courses as $course)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="course-block mx-auto">
                        <a href="{{ route('course.view', $course->course_slug) }}" class="c-view">
                            <main>
                                <img src="@if(Storage::exists($course->thumb_image)){{ Storage::url($course->thumb_image) }}@else{{ asset('backend/assets/images/course_detail_thumb.jpg') }}@endif">
                                <div class="col-md-12">
                                    <h6 class="course-title">{{ $course->course_title }}</h6>
                                </div>

                                <div class="instructor-clist">
                                    <div class="col-md-12">
                                        <i class="fa fa-chalkboard-teacher"></i>&nbsp;
                                        <span><b>{{ $course->first_name.' '.$course->last_name }}</b></span>
                                    </div>
                                </div>
                            </main>
                            <footer>
                                <div class="d-flex flex-wrap flex-row-reverse">
                                    <div class="p-2 pr-4">
                                        <star class="course-rating">
                                            <?php for ($r = 1; $r <= 5; $r++) { ?>
                                                <span class="fa fa-star <?php echo $r <= $course->ratings->avg('rating') ? 'checked' : ''; ?>"></span>
                                            <?php } ?>
                                        </star>
                                    </div>
                                </div>
                            </footer>
                        </a>
                    </div>
                </div>
                @endforeach
                @else
                <article class="container not-found-block">
                    <div class="row">
                        <div class="col-12 not-found-col">
                            <span><b>2<span class="blue">0</span>4</b></span>
                            <h3>Você não possui cursos ainda. Comece a aprender agora!</h3>
                            <a href="{{ route('course.list') }}" class="btn btn-ulearn-cview mt-3">Explore Courses</a>
                        </div>
                    </div>
                </article>
                @endif
            </div>
        </div>
    </div>

</div>
<!-- course list end -->
@endsection