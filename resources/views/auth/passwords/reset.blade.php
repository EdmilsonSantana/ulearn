@extends('layouts.frontend.index')

@section('content')
<div class="login-page">

    <div class="d-flex flex-row justify-content-center">
        <div class="p-2">
            <form id="loginForm" class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <h1 class="title">Redefinir Senha</h1>

                <div class="p-4">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control form-control-sm" value="@if(!empty($name)){{ $email }}@else{{ old('email') }}@endif" name="email">
                        @if ($errors->has('email'))
                        <label class="error" for="email">{{ $errors->first('email') }}</label>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" class="form-control form-control-sm" name="password" id="password">
                        @if ($errors->has('password'))
                        <label class="error" for="password">{{ $errors->first('password') }}</label>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Confirmação de Senha</label>
                        <input type="password" class="form-control form-control-sm"  name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                        <label class="error" for="password_confirmation">{{ $errors->first('password_confirmation') }}</label>
                        @endif
                    </div>

                    <div class="form-group  pt-4">
                        <button type="submit" class="btn btn-lg btn-block btn-learna btn-learna-primary">Redefinar Senha</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- account block end -->
</div>
<!-- content end -->
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                email: {
                    required: 'O campo de email é obrigatório.',
                    email: 'O email deve ser um endereço de email válido.'
                },
                password: {
                    required: 'O campo de senha é obrigatório.',
                    minlength: 'A senha deve ter pelo menos 6 caracteres.'
                },
                password_confirmation: {
                    required: 'O campo de confirmação de senha é obrigatório.',
                    equalTo: 'A confirmação da senha não corresponde a senha informada.'
                }
            }
        });

    });
</script>
@endsection