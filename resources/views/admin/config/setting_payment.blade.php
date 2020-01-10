@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Pagamento</h1>
</div>

<div class="page-content">

<div class="panel">
  <div class="panel-body">
    <form method="POST" action="{{ route('admin.saveConfig') }}" class="register-form">
      {{ csrf_field() }}
      <input type="hidden" name="code" value="settingPayment">
        <div class="row">
            <div class="form-group col-md-6">
              <label class="form-control-label">Nome</label>
              <input type="text" class="form-control" name="username" 
                placeholder="Nome" value="{{ isset($config['username']) ? $config['username'] : '' }}" />
            </div>
        
            <div class="form-group col-md-6">
              <label class="form-control-label">Senha</label>
              <input type="text" class="form-control" name="password" 
                placeholder="Senha" value="{{ isset($config['password']) ? $config['password'] : '' }}" />
            </div>

            <div class="form-group col-md-6">
              <label class="form-control-label">Assinatura</label>
              <input type="text" class="form-control" name="signature" 
                placeholder="Assinatura" value="{{ isset($config['signature']) ? $config['signature'] : '' }}" />
            </div>

            <div class="form-group col-md-3">
                <label class="form-control-label">Modo de Testes</label>
                <div>
                  <div class="radio-custom radio-default radio-inline">
                    <input type="radio" id="inputBasicActive" name="test_mode" value="1" @if(!isset($config['test_mode'])) checked @endif @if(isset($config['test_mode']) && $config['test_mode'] == 1) checked @endif/>
                    <label for="inputBasicActive">Ativo</label>
                  </div>
                  <div class="radio-custom radio-default radio-inline">
                    <input type="radio" id="inputBasicInactive" name="test_mode" value="0" @if(isset($config['test_mode']) && $config['test_mode'] == 0) checked @endif/>
                    <label for="inputBasicInactive">Inativo</label>
                  </div>
                </div>
            </div>

            <div class="form-group col-md-3">
                <label class="form-control-label">Status</label>
                <div>
                  <div class="radio-custom radio-default radio-inline">
                    <input type="radio" id="inputBasic1Active" name="is_active" value="1" 
                    @if(!isset($config['is_active'])) checked @endif @if(isset($config['is_active']) && $config['is_active'] == 1) checked @endif/>
                    <label for="inputBasic1Active">Ativo</label>
                  </div>
                  <div class="radio-custom radio-default radio-inline">
                    <input type="radio" id="inputBasic1Inactive" name="is_active" value="0" 
                    @if(isset($config['is_active']) && $config['is_active'] == 0) checked @endif/>
                    <label for="inputBasic1Inactive">Inativo</label>
                  </div>
                </div>
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
