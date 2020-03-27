@extends('layouts.frontend.index')

@section('content')
<!-- content start -->
<div class="login-page">
    <!-- account block start -->
    <div class="d-flex flex-row justify-content-center">
        <div class="p-2">
            <form id="loginForm" class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                
                <h1 class="title">Recuperar Senha</h1>
                <p class="subtitle">Esqueceu sua senha? Digite seu e-mail que enviaremos um link para definir uma nova senha.</p>
                
                <div class="p-4">
                    
                    <div class="form-group">
                        <label>E-mail</label>
                        <input name="email" type="text" class="form-control form-control-sm" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <label class="error" for="email">{{ $errors->first('email') }}</label>
                        @endif
                    </div>

                    <div class="form-group pt-4">
                        <button type="submit" class="btn btn-lg btn-block btn-learna btn-learna-primary">Recuperar Senha</button>
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
                }
            },
            messages: {
                email: {
                    required: 'O campo de email é obrigatório.',
                    email: 'O email deve ser um endereço de email válido.'
                }
            }
        });

    });
</script>
@endsection