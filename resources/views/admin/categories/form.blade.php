@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Adicionar Categoria</h1>
</div>

<div class="page-content">

  <div class="panel">
    <div class="panel-body">
      <form method="POST" action="{{ route('admin.saveCategory') }}" class="register-form" id="categoryForm">
        {{ csrf_field() }}
        <input type="hidden" name="category_id" value="{{ $category->id }}">
        <div class="row">

          <div class="form-group col-md-4">
            <label class="form-control-label">Nome <span class="required">*</span></label>
            <input type="text" class="form-control" name="name" placeholder="Nome" value="{{ $category->name }}" />
            @if ($errors->has('name'))
            <label class="error" for="name">{{ $errors->first('name') }}</label>
            @endif
          </div>

          <div class="form-group col-md-4">
            <div class="d-flex flex-column">
              <label class="pb-0 mb-0 form-control-label">Ícone <span class="required">*</span></label>
              <small>Referência: <a href="https://fontawesome.com/icons?d=gallery" target="_blank">Font Awesome</a> icons</small>
            </div>

            <input type="text" class="form-control" name="icon_class" placeholder="Ícone" value="{{ $category->icon_class }}" />

            @if ($errors->has('icon_class'))
            <label class="error" for="name">{{ $errors->first('icon_class') }}</label>
            @endif
          </div>


          <div class="form-group col-md-4">
            <label class="form-control-label">Status</label>
            <div>
              <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="inputBasicActive" name="is_active" value="1" @if($category->is_active) checked @endif />
                <label for="inputBasicActive">Ativo</label>
              </div>
              <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="inputBasicInactive" name="is_active" value="0" @if(!$category->is_active) checked @endif/>
                <label for="inputBasicInactive">Inativo</label>
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

@section('javascript')
<script type="text/javascript">
  $(document).ready(function() {
    $("#categoryForm").validate({
      rules: {
        name: {
          required: true
        },
        icon_class: {
          required: true
        }
      },
      messages: {
        name: {
          required: 'Este campo é obrigatório.'
        },
        icon_class: {
          required: 'Este campo é obrigatório.'
        }
      }
    });
  });
</script>
@endsection