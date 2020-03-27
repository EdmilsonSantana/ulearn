@component('mail::message')
# Olá {{ $name }}
Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.
@component('mail::button', ['url' => $url])
Redefinir Senha
@endcomponent
Atenciosamente,<br>
{{ config('app.name') }}
@component('mail::subcopy', ['url' => $url])
Se estiver com problemas para clicar no botão "Redefinir senha", copie e cole o URL abaixo no seu navegador da web: [{{ $url}}]({{ $url}})
@endcomponent
@endcomponent