@extends('layouts.frontend.index')

@section('content')
<!-- content start -->

<!-- account block start -->

<div class="login-page">

    <div class="d-flex flex-row justify-content-center">
        <div class="p-2">
        <form id="loginForm" class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <h1 class="title">Já é nosso Aluno ?</h1>
            <p class="subtitle">Faça seu login e boa aula!</p>

            <div class="p-4">

                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="text" class="form-control form-control-sm" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                    <label class="error" for="email">{{ $errors->first('email') }}</label>
                    @endif
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input name="password" type="password" class="form-control form-control-sm" value="{{ old('password') }}">
                    @if ($errors->has('password'))
                    <label class="error" for="password">{{ $errors->first('password') }}</label>
                    @endif
                </div>

                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-lg btn-block btn-learna btn-learna-primary">ENTRAR</button>
                </div>

            </div>
            <div class="form-group forgot-text">
                <a href="{{ route('password.request') }}">Esqueci minha senha</a>
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
                    required: true
                }
            },
            messages: {
                email: {
                    required: 'O campo de email é obrigatório.',
                    email: 'O email deve ser um endereço de email válido.'
                },
                password: {
                    required: 'O campo de senha é obrigatório.'
                }
            }
        });

    });
</script>
@endsection