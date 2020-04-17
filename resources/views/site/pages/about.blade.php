@extends('layouts.frontend.index')
@section('content')
<!-- content start -->
<div class="container-fluid p-0">
    <!-- banner start -->
    <div class="subpage-slide-blue">
        <div class="container">
            <h1>Quem Somos</h1>
        </div>
    </div>
    <!-- banner end -->
    <div class="content-panel">
        {!! Sitehelpers::get_option('pageAbout', 'content') !!}
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">

</script>
@endsection