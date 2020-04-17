@extends('layouts.frontend.index')
@section('content')
<!-- content start -->
<div class="container-fluid p-0">
    <!-- banner start -->
    <div class="subpage-slide-blue">
        <div class="container">
            <h1>Contato</h1>
        </div>
    </div>
    <!-- banner end -->

    <div class="content-panel">
        <div class="container">

            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 vertical-align d-none d-lg-block mt-5">
                    {!! Sitehelpers::get_option('pageContact', 'map') !!}
                </div>
                <div class="col-xl-6 offset-xl-0 col-lg-6 offset-lg-0 col-md-8 offset-md-2">
                    <div class="m-5">


                        <form class="form-horizontal" method="POST" action="{{ route('contact.admin') }}" id="contactForm">
                            <div class="box-header mb-5">
                                <p class="subtitle">Fale Conosco</h1>
                            </div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Nome</label>
                                        <input type="text" class="form-control form-control-sm" name="first_name">
                                    </div>
                                    <div class="col-6">
                                        <label>Sobrenome</label>
                                        <input type="text" class="form-control form-control-sm" name="last_name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" class="form-control form-control-sm" name="email_id">
                            </div>

                            <div class="form-group">
                                <label>Mensagem</label>
                                <textarea class="form-control form-control" name="message"></textarea>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-lg btn-block btn-learna btn-learna-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection


    @section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#contactForm").validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    email_id: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true
                    }
                },
                messages: {
                    first_name: {
                        required: 'Este campo é obrigatório.'
                    },
                    last_name: {
                        required: 'Este campo é obrigatório.'
                    },
                    email_id: {
                        required: 'Este campo é obrigatório.',
                        email: 'Por favor, informe um e-mail válido.'
                    },
                    message: {
                        required: 'Este campo é obrigatório.'
                    }
                }
            });

        });
    </script>
    @endsection