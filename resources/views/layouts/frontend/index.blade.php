<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Universidade do Automóvel</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="all,follow">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/fancybox.css') }}">
        
        <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">

        <link rel="stylesheet" href="{{ asset('frontend/css/lity.min.css') }}">

        <link rel="stylesheet" href="{{ asset('backend/fonts/web-icons/web-icons.min599c.css?v4.0.2') }}">
        <link rel="stylesheet" href="{{ asset('backend/vendor/toastr/toastr.min599c.css?v4.0.2') }}">
        <!-- Rating -->
        <link rel="stylesheet" href="{{ asset('frontend/vendor/rating/fontawesome-stars.css') }}">

        <!-- Video JS --> 
        <link href="https://vjs.zencdn.net/7.6.6/video-js.css" rel="stylesheet" />

    </head>
    <body>
    <div class="se-pre-con"></div>
    <!-- Header -->

    <nav class="navbar-default d-flex align-items-center justify-content-between">
            <div class="mr-auto" id="logo">
                <i class="fa fa-bars d-inline-block d-md-none mobile-nav"></i>
                <a href="{{ route('home') }}" class="float-xl-right"><img src="{{ asset('frontend/img/logo-original.png') }}" height="60" /></a>
            </div>
            <div class="p-2">
                <div class="dropdown float-right" >
                  <a id="dropdownMenu" class="btn btn-secondary btn-link dropdown-toggle" data-toggle="dropdown">Categorias</a>
                    <?php 
                        $categories = SiteHelpers::active_categories();
                    ?>
                 <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                    @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ route('course.list','category_id[]='.$category->id) }}">
                            <i class="fa {{ $category->icon_class }} category-menu-icon"></i>
                            {{ $category->name}}
                        </a>
                    @endforeach
                  </div>
                </div>
            </div>

            <div class="p-2 vertical-divider"></div>

            <div class="">
                @guest
                <div class="d-flex justify-content-end align-items-center">
                    <a class="btn btn-learna" href="{{ route('login') }}">Fazer Login</a>
                    <!--<a class="btn btn-learna btn-learna-primary" href="{{ route('register') }}">Cadastre-se</a> -->
                </div>
                @else
                <div class="d-flex justify-content-end align-items-center">
                 <a class="btn btn-secondary btn-link" href="{{ route('my.courses') }}" >
                     <i class="fa fa-graduation-cap"></i> Meus cursos
                 </a>

                 <a class="btn btn-secondary btn-link" href="{{ route('logOut') }}" >
                     <i class="fa fa-sign-out-alt"></i> Sair
                 </a>
                 <!--
                  <span id="dropdownMenuButtonRight" class="btn btn-secondary btn-link" data-toggle="dropdown">{{ Auth::user()->first_name }} &nbsp;<i class="fa fa-caret-down"></i></span>
                    
                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButtonRight">
                    -->
                 <!--
                    @if(Auth::user()->hasRole('instructor'))
                    <a class="dropdown-item" href="{{ route('instructor.dashboard') }}" >
                        <i class="fa fa-sign-out-alt"></i> Instructor
                    </a>
                    @endif
                    -->
                    
                  </div>
                </div>

                @endguest
            </div>
    </nav>

    <div id="sidebar">
        <ul>
           <li><a href="javascript:void(0)" class="sidebar-title">Categories</a></li>
           @foreach ($categories as $category)
           <li>
                <a href="{{ $category->slug }}">
                    <i class="fa {{ $category->icon_class }} category-menu-icon"></i>
                    {{ $category->name}}
                </a>
           </li>
           @endforeach
        </ul>
    </div>
    @yield('content')

    <!-- footer start -->
    
    <footer id="main-footer">
            <div class="container-fluid">
                <div class="row">
                        <ul>
                            <li><a href="{{ route('page.about') }}">Quem Somos</a></li>
                            <li><a href="{{ route('page.contact') }}">Contato</a></li>
                        </ul>
                </div>
            </div>
            <hr />
            <div class="container-fluid">
            <div class="row align-items-center">
                    <div>
                        <img src="{{ asset('frontend/img/logo-original.png') }}" class="img-fluid" width="105" height="24">
                    </div>
                    <div>
                        <span id="c-copyright">
                            Copyright © {{ date("Y") }} Universidade do Automóvel.
                        </span>
                    </div>
                </div>
            </div>
            <hr class="hr-primary"/>
    </footer>
    <!-- footer end -->

    <!-- The Modal start -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bi-header ">
            <h5 class="col-12 modal-title text-center bi-header-seperator-head">Become an Instructor</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
           
        <div class="becomeInstructorForm">
           <form id="becomeInstructorForm" class="form-horizontal" method="POST" action="{{ route('become.instructor') }}">
            {{ csrf_field() }}
                <div class="px-4 py-2">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label>First Name</label>
                                <input type="text" class="form-control form-control-sm" placeholder="First Name" name="first_name">
                            </div>
                            <div class="col-6">
                                <label>Last Name</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Last Name" name="last_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Contact Email</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Contact Email" name="contact_email">
                    </div>

                    <div class="form-group">
                        <label>Telephone</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Telephone" name="telephone">
                    </div>

                    <div class="form-group">
                        <label>Paypal ID</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Paypal ID" name="paypal_id">
                    </div>

                    <div class="form-group">
                        <label>Biography</label>
                        <textarea class="form-control form-control" placeholder="Biography" name="biography"></textarea>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-lg btn-block login-page-button">Submit</button>
                    </div>

                </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    <!-- The Modal end -->
    </body>
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/modernizr.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('frontend/js/lity.min.js') }}"></script>

    <!-- Rating -->
    <script src="{{ asset('frontend/vendor/rating/jquery.barrating.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('backend/vendor/toastr/toastr.min599c.js?v4.0.2') }}"></script>
    
    <!-- Video JS -->
    <script src="https://vjs.zencdn.net/7.6.6/video.js"></script>

    <script>
    $(window).on("load", function (e){
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function()
        {   

            $('#dropdownMenu:hover').dropdown('toggle');
            
            /* Delete record */
            $('.delete-record').click(function(event)
            {
                var url = $(this).attr('href');
                event.preventDefault();
                
                if(confirm('Tem certeza que deseja remover este registro ?'))
                {
                    window.location.href = url;
                } else {
                    return false;
                }

            });

            /* Toastr messages */
            toastr.options.closeButton = true;
            toastr.options.timeOut = 5000;
            @if(session()->has('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if(session()->has('status'))
                toastr.success("{{ session('status') }}");
            @endif
            @if(session()->has('error'))
                toastr.error("{{ session('error') }}");
            @endif
            @if(session()->has('info'))
                toastr.info("{{ session('info') }}");
            @endif

            $('.mobile-nav').click(function()
            {
                $('#sidebar').toggleClass('active');
                
                $(this).toggleClass('fa-bars');
                $(this).toggleClass('fa-times');
            });

            $("#becomeInstructorForm").validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    contact_email:{
                        required: true,
                        email:true
                    },
                    telephone: {
                        required: true
                    },
                    paypal_id:{
                        required: true,
                        email:true
                    },
                    biography: {
                        required: true
                    },
                },
                messages: {
                    first_name: {
                        required: 'The first name field is required.'
                    },
                    last_name: {
                        required: 'The last name field is required.'
                    },
                    contact_email: {
                        required: 'The contact email field is required.',
                        email: 'The contact email must be a valid email address.'
                    },
                    telephone: {
                        required: 'The telephone field is required.'
                    },
                    paypal_id: {
                        required: 'The paypal id field is required.',
                        email: 'The paypal id must be a valid email address.'
                    },
                    biography: {
                        required: 'The biography field is required.'
                    },
                }
            });
        });
    </script>
    @yield('javascript')
</html>
