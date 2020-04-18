@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Adicionar Curso</h1>
</div>

<div class="page-content">

<div class="panel">
  <div class="panel-body">

    
    @include('instructor/course/tabs')
    

    <form method="POST" action="{{ route('instructor.course.info.save') }}" class="register-form" id="courseForm">
      {{ csrf_field() }}
      <input type="hidden" name="course_id" value="{{ $course->id }}">
      <div class="row">
      
        <div class="form-group col-md-4">
            <label class="form-control-label">Título <span class="required">*</span></label>
            <input type="text" class="form-control" name="course_title" 
                placeholder="Título" value="{{ $course->course_title }}" />
                @if ($errors->has('course_title'))
                    <label class="error" for="course_title">{{ $errors->first('course_title') }}</label>
                @endif
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Categoria <span class="required">*</span></label>
            <select class="form-control" name="category_id">
                <option value="">Selecione</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                    @if($category->id == $course->category_id){{ 'selected' }}@endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            
            @if ($errors->has('category_id'))
                <label class="error" for="category_id">{{ $errors->first('category_id') }}</label>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Nível de Instrução <span class="required">*</span></label>
            <select class="form-control" name="instruction_level_id">
                <option value="">Selecione</option>
                @foreach($instruction_levels as $instruction_level)
                    <option value="{{ $instruction_level->id }}" 
                    @if($instruction_level->id == $course->instruction_level_id){{ 'selected' }}@endif>
                        {{ $instruction_level->level }}
                    </option>
                @endforeach
            </select>
            
            @if ($errors->has('instruction_level_id'))
                <label class="error" for="instruction_level_id">{{ $errors->first('instruction_level_id') }}</label>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Duração</label>
            <input type="text" class="form-control" name="duration" 
                placeholder="Duração do Curso" value="{{ $course->duration }}" />
        </div>

        <div class="form-group col-md-8">
            <label class="form-control-label">Palavras-chave</label>
            <input type="text" class="form-control tagsinput" name="keywords" 
                placeholder="Palavras-chave" value="{{ $course->keywords }}" />
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Preço <i class="fa fa-info-circle" data-toggle="tooltip" data-original-title="Deixe em branco se o curso for gratuito."></i></label>
            <input type="number" class="form-control" name="price" 
                placeholder="Preço" value="{{ $course->price }}" />
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Preço (Sem descontos)  <i class="fa fa-info-circle" data-toggle="tooltip" data-original-title="Aplicado apenas em cursos pagos."></i></label>
            <input type="text" class="form-control" name="strike_out_price" 
                placeholder="Preço (Sem descontos)" value="{{ $course->strike_out_price }}" />
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Status</label>
            <div>
              <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="inputBasicActive" name="is_active" value="1" @if($course->is_active) checked @endif />
                <label for="inputBasicActive">Ativo</label>
              </div>
              <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="inputBasicInactive" name="is_active" value="0" @if(!$course->is_active) checked @endif/>
                <label for="inputBasicInactive">Inativo</label>
              </div>
            </div>
        </div>





        <div class="form-group col-md-12">
            <label class="form-control-label">Resumo</label>
            <textarea name="overview">
                {{ $course->overview }}
            </textarea>
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
        tinymce.init({ 
            selector:'textarea',
            menubar:false,
            statusbar: false,
            content_style: "#tinymce p{color:#414146;}"
        });

        $(".tagsinput").tagsinput();

        $("#courseForm").validate({
            rules: {
                course_title: {
                    required: true
                },
                category_id: {
                    required: true
                },
                instruction_level_id: {
                    required: true
                }
            },
            messages: {
                course_title: {
                    required: 'Este campo é obrigatório.'
                },
                category_id: {
                    required: 'Este campo é obrigatório.'
                },
                instruction_level_id: {
                    required: 'Este campo é obrigatório.'
                }
            }
        });

        $('.course-id-empty').click(function()
        {
            toastr.options = {
                "positionClass": "toast-top-full-width",
            };
            toastr.error("Preencha as informações gerais do curso para prosseguir");
        });
    });
</script>
@endsection