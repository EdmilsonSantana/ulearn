@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Contato</h1>
</div>

<div class="page-content">

  <div class="panel">
    <div class="panel-body">
      <form class="register-form" method="POST" action="{{ route('admin.saveConfig') }}">
        {{ csrf_field() }}
        <input type="hidden" name="code" value="pageContact">
        <div class="row">
          <!--<div class="form-group col-md-6">
              <label class="form-control-label">Telephone</label>
              <input type="text" class="form-control" name="telephone" 
                placeholder="Telephone" value="{{ isset($config['telephone']) ? $config['telephone'] : '' }}" />
            </div>
            -->
<!--
          <div class="form-group col-md-6">
            <label class="form-control-label">Endereço</label>
            <textarea name="address" class="form-control">{{ isset($config['address']) ? $config['address'] : '' }}</textarea>
          </div>
-->
          <div class="form-group col-md-6">
            <label class="form-control-label">Google Maps Iframe</label>
            <textarea name="map" class="form-control">{{ isset($config['map']) ? $config['map'] : '' }}</textarea>
          </div>

<!--
          <div class="form-group col-md-6">
            <label class="form-control-label">E-mail</label>
            <input type="text" class="form-control" name="email" value="{{ isset($config['email']) ? $config['email'] : '' }}" />
          </div>
-->
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