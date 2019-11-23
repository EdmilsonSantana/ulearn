@extends('layouts.frontend.index')
@section('content')
<!-- content start -->
<div class="container-fluid p-0">
    <!-- banner start -->
    <div class="homepage-slide-blue d-flex flex-column justify-content-center">

        <!-- <h1 class="title-header">{{ Sitehelpers::get_option('pageHome', 'banner_title') }}</h1> -->

        <h1 class="title-header">Treinamentos em Sistemas Eletromecânicos </h1>
        <!--<span class="p-2 title-sub-header">{{ Sitehelpers::get_option('pageHome', 'banner_text') }}</span> -->

        <span class="title-sub-header">Estude a qualquer hora. Há milhares de cursos ministrados por especialistas.</span>
        <div class="">
            <form method="GET" action="{{ route('course.list') }}">
                <div class="searchbox-contrainer col-md-5">
                    <div class="input-group">
                        <input name="keyword" type="search" class="searchbox d-none d-sm-inline-block form-control border-right-0 border" placeholder="O que você quer aprender ?">
                        <span class="input-group-append">
                            <button type="submit" class="searchbox-submit btn btn-outline-secondary border-left-0 border"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <!-- banner end -->




    <div class="learn-block d-flex flex-nowrap">
        <div class="p-2 about-courses-block">
            <h3 class="dblock-heading">Uma seleção de cursos especializados</h3>
            <p class="dblock-text">Aprenda com profissionais capacitados e especializados no assunto</p>
        </div>
        <div class="p-2 flex-shrink-1">
            <!-- Courses by Category Start -->
            <div id="course_tabs" data-site-url='{{ url("/") }}'></div>
            <!-- Courses by Category Ends -->
        </div>
    </div>
    <hr class="hr-secondary" />
    <!-- testimonials block start -->
    <article class="testimonials-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center mt-3">
                    <p class="testimonials-block-title">O que dizem nossos alunos</p>
                    <!--<p class="mt-3">{{ Sitehelpers::get_option('pageHome', 'instructor_text') }}</p>-->
                </div>
            </div>

            <div>
                <div id="testimonials_list" data-site-url='{{ url("/") }}'></div>
            </div>
        </div>
    </article>

    <!-- testimonials block end -->

</div>
<!-- content end -->
@endsection

@section('javascript')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
