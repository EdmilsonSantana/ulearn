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
                @php
                $ratings_count = $course->ratings->count('rating');
                $average_rating = $course->ratings->avg('rating');

                $rating = $ratings_count > 1 ? $ratings_count . ' classificações' : $ratings_count. ' classificação';
                $count =  $students_count > 1 ? $students_count .' alunos inscritos' : $students_count . ' aluno inscrito';
                @endphp

                <div class="cv-category-detail cv-rating float-lg-left float-md-right float-sm-right">
                    <star class="course-rating">
                        @for($r=1;$r<=5;$r++) <span class="fa fa-star {{ $r <= $average_rating ? 'checked-vpage' : ''}}"></span>
                            @endfor
                    </star>
                    
                    <span>{{ number_format($average_rating, 1) }} ({{ $rating }}) {{ $count }} </span>
                </div>
            </div>
        </div>
    </div>
</div>