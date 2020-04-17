@extends('layouts.email')
@section('subject')
{{ env('APP_NAME') }}
@endsection

@section('content')
        Administrador,<br/>
        <p>Gostaríamos de informar que um usuário entrou em contato. Segue:</p>
        <p>
        Nome: {{ $enquiry->first_name }}<br/>
        Sobrenome: {{ $enquiry->last_name }}<br/>
        E-mail: {{ $enquiry->email_id }}<br/>
        Mensagem :{{ $enquiry->message }}<br/>
        </p>
@endsection
