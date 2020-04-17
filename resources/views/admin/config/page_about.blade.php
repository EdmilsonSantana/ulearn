@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Quem Somos</h1>
</div>

<div class="page-content">

  <div class="panel">
    <div class="panel-body">
      <form method="POST" class="register-form" action="{{ route('admin.saveConfig') }}">
        {{ csrf_field() }}
        <input type="hidden" name="code" value="pageAbout">
        <div class="row">
          <div class="form-group col-md-12">
            <label class="form-control-label">Conteúdo</label>
            <textarea name="content">{{ isset($config['content']) ? $config['content'] : '' }}</textarea>
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
    tinymce.init({
      selector: "textarea", // change this value according to your HTML
      plugins: "code",
      toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | code",
      menubar: false,
      height: 500,
      content_style: "#tinymce {color:#76838f;}",
      extended_valid_elements: 'i[class]'
    });
  });
</script>

@endsection