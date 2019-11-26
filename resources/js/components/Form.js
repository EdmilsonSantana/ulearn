import React from 'react';

export default class Form extends React.Component {

    render() {
        return (
            <form id={this.props.id} class="form-horizontal" method="POST" action={this.props.action}>
            {{ csrf_field() }}
            <h1 class="title">Já é nosso Aluno ?</h1>
            <p class="subtitle">Faça seu login e boa aula!</p>

            <div class="p-2">
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

                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-block btn-learna btn-learna-primary">ENTRAR</button>
                </div>

            </div>
            <div class="form-group forgot-text">
                <a href="{{ route('password.request') }}">Esqueci minha senha</a>
            </div>
        </form>
        );
    }
}