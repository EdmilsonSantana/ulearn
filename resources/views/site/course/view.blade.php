@extends('layouts.frontend.index')
@section('content')
<div>
    <div class="container-fluid page-main-content">

        @include('site/course/components/course-banner')

        <div class="container">
            <div class="row mt-4">

                <div class="col-xl-8 col-lg-8 col-md-7">
                    @include('site/course/components/course-overview', ['is_learning' => false])
                </div>

                <div class="col-xl-4 col-lg-4 col-md-5 d-none d-md-block">
                    @include('site/course/components/course-sidebar', ['is_learning' => false])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection