@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Adicionar Usuário</h1>
</div>

<div class="page-content">

<div class="panel">
  <div class="panel-body">
    <form method="POST" action="{{ route('admin.saveUser') }}" class="register-form" id="userForm">
      {{ csrf_field() }}
      <input type="hidden" name="user_id" value="{{ $user->id }}">
      <div class="row">
      
        <div class="form-group col-md-4">
          <label class="form-control-label">Nome <span class="required">*</span></label>
          <input type="text" class="form-control" name="first_name" 
            placeholder="Nome" value="{{ $user->first_name }}" />
            @if ($errors->has('first_name'))
                <label class="error" for="first_name">{{ $errors->first('first_name') }}</label>
            @endif
        </div>
      
        <div class="form-group col-md-4">
          <label class="form-control-label">Sobrenome <span class="required">*</span></label>
          <input type="text" class="form-control" name="last_name"
            placeholder="Sobrenome" value="{{ $user->last_name }}" />
            @if ($errors->has('last_name'))
                <label class="error" for="last_name">{{ $errors->first('last_name') }}</label>
            @endif
        </div>
      
      <div class="form-group col-md-4">
        <label class="form-control-label">E-mail @if(!$user->id) <span class="required">*</span> @endif</label>
        <input type="text" class="form-control" name="email"
          placeholder="E-mail" value="{{ $user->email }}" @if($user->email) readonly @endif/>
        @if ($errors->has('email'))
            <label class="error" for="email">{{ $errors->first('email') }}</label>
        @endif
      </div>
      <div class="form-group col-md-4">
        <label class="form-control-label">Status</label>
        <div>
          <div class="radio-custom radio-default radio-inline">
            <input type="radio" id="inputBasicActive" name="is_active" value="1" @if($user->is_active) checked @endif />
            <label for="inputBasicActive">Ativo</label>
          </div>
          <div class="radio-custom radio-default radio-inline">
            <input type="radio" id="inputBasicInactive" name="is_active" value="0" @if(!$user->is_active) checked @endif/>
            <label for="inputBasicInactive">Inativo</label>
          </div>
        </div>
      </div>

      <div class="form-group col-md-4">
          <label class="form-control-label">Papél <span class="required">*</span></label>
          <div>
              <div class="checkbox-custom checkbox-default checkbox-inline">
                <input type="checkbox" id="inputCheckboxStudent" name="roles[]" value="student" @if($user->id && $user->hasRole('student')) checked @endif>
                <label for="inputCheckboxStudent">Estudante</label>
              </div>
              <div class="checkbox-custom checkbox-default checkbox-inline">
                <input type="checkbox" id="inputCheckboxInstructor" name="roles[]" value="instructor" @if($user->id &&  $user->hasRole('instructor')) checked @endif>
                <label for="inputCheckboxInstructor">Instrutor</label>
              </div>
              <div id="role-div-error">
              @if ($errors->has('roles'))
                <label class="error">{{ $errors->first('roles') }}</label>
              @endif
              </div>
          </div>
      </div>
      
      <div class="form-group col-md-4">
        <label class="form-control-label" >Senha @if(!$user->id) <span class="required">*</span> @endif</label>
        <input type="password" class="form-control"  name="password"
          placeholder="Senha"/>
        @if ($errors->has('password'))
            <label class="error" for="password">{{ $errors->first('password') }}</label>
        @endif
      </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col-md-4">
        @include('admin/components/button', ['type' => 'submit', 'primary' => 'true', 'text' => 'Salvar'])
        @include('admin/components/button', ['type' => 'reset', 'primary' => '', 'text' => 'Limpar'])
        </div>
      </div>
      
    </form>
  </div>
</div>

       
      <!-- End Panel Basic -->
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function()
    { 
        $("#userForm").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                @if(!$user->id)
                email:{
                    required: true,
                    email:true,
                    remote: "{{ url('checkUserEmailExists') }}"
                },
                password:{
                    required: true,
                    minlength: 6
                },
                @endif
                "roles[]": {
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
                email: {
                    required: 'Este campo é obrigatório.',
                    email: 'Informe um endereço de e-mail válido.',
                    remote: 'Este e-mail já está em uso.'
                },
                password: {
                    required: 'Este campo é obrigatório.',
                    minlength: 'A senha deve ter no mínimo 6 caracteres.'
                },
                "roles[]": {
                    required: 'Este campo é obrigatório.'
                }
            },
            errorPlacement: function(error, element) {
                if(element.attr("name") == "roles[]") {
                    error.appendTo("#role-div-error");
                }else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>
@endsection