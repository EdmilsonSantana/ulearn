<div class="course-banner">
    <div class="container">
        <h4 class="course-banner-title">{{ $course->course_title }}</h4>
        <div class="course-banner-header">
            <div class="course-category-icon">
                <i class="far fa-bookmark"></i>
            </div>
            <div class="course-category-detail">
                <span>Categoria</span>
                <br>
                {{ $course->category->name }}
            </div>
        </div>

        <br />

        <div>
            <i class="fa fa-chalkboard-teacher"></i>&nbsp;
            <span>Criado por <b>{{ $course->instructor->first_name.' '.$course->instructor->last_name }}</b></span>
        </div>

        <div class="d-flex">

            <div class="m-1">
                <div class="cv-category-detail cv-rating float-lg-left float-md-right float-sm-right">
                    <star class="course-rating">
                        @for($r=1;$r<=5;$r++) <span class="fa fa-star {{ $r <= $course->ratings->avg('rating') ? 'checked-vpage' : ''}}"></span>
                            @endfor
                    </star>
                    <span>{{ $course->ratings->count('rating') }} </span>
                </div>
            </div>

            <div class="m-1">
                <span> (199 classificações) </span><span> 199 alunos inscritos </span>
            </div>
        </div>
    </div>
</div>