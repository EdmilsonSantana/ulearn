@extends('layouts.backend.index')
@section('content')
<style type="text/css">

    label.cabinet{
    display: block;
    cursor: pointer;
}
label.cabinet input.file{
    position: relative;
    height: 100%;
    width: auto;
    opacity: 0;
    -moz-opacity: 0;
  filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  margin-top:-30px;
}

.cabinet.center-block{
    margin-bottom: -1rem;
}

#upload-demo{
    width: 558px;
    height: 372px;
  padding-bottom:25px;
}
figure figcaption {
    position: absolute;
    bottom: 0;
    color: #fff;
    width: 100%;
    padding-left: 9px;
    padding-bottom: 5px;
    text-shadow: 0 0 10px #000;
}
.course-image-container{
    width: 300px;
    height: 200px;
    border: 1px solid #e4eaec;;
    position: relative;
}
.course-image-container img{
    width: 258px;
    height: 172px;
    position: absolute;  
    top: 0;  
    bottom: 0;  
    left: 0;  
    right: 0;  
    margin: auto;
}
.remove-lp{
    font-size: 16px;
    color: red;
    float: right;
    padding-right: 2px;
}
</style>
<div class="page-header">
  <h1 class="page-title">Perfil</h1>
</div>

<div class="page-content">

<div class="panel">
  <div class="panel-body">

    <form method="POST" action="{{ route('instructor.profile.save') }}" class="register-form" id="profileForm" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">
      <input type="hidden" name="old_course_image" value="{{ $instructor->instructor_image }}">
      <div class="row">
      
        <div class="form-group col-md-4">
            <label class="form-control-label">Nome <span class="required">*</span></label>
            <input type="text" class="form-control" name="first_name" 
                value="{{ $instructor->first_name }}" />
                @if ($errors->has('first_name'))
                    <label class="error" for="first_name">{{ $errors->first('first_name') }}</label>
                @endif
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Sobrenome <span class="required">*</span></label>
            <input type="text" class="form-control" name="last_name" 
                value="{{ $instructor->last_name }}" />
                @if ($errors->has('last_name'))
                    <label class="error" for="last_name">{{ $errors->first('last_name') }}</label>
                @endif
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">E-mail <span class="required">*</span></label>
            <input type="text" class="form-control" name="contact_email" 
                value="{{ $instructor->contact_email }}" />
                @if ($errors->has('contact_email'))
                    <label class="error" for="contact_email">{{ $errors->first('contact_email') }}</label>
                @endif
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Telefone <span class="required">*</span></label>
            <input type="text" class="form-control" name="telephone" 
                value="{{ $instructor->telephone }}" />
                @if ($errors->has('telephone'))
                    <label class="error" for="telephone">{{ $errors->first('telephone') }}</label>
                @endif
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Celular </label>
            <input type="text" class="form-control" name="mobile" 
                value="{{ $instructor->mobile }}" />
                @if ($errors->has('mobile'))
                    <label class="error" for="mobile">{{ $errors->first('mobile') }}</label>
                @endif
        </div>
<!--
        <div class="form-group col-md-4">
            <label class="form-control-label">Paypal ID <span class="required">*</span></label>
            <input type="text" class="form-control" name="paypal_id" 
                placeholder="Paypal ID" value="{{ $instructor->paypal_id }}" />
                @if ($errors->has('paypal_id'))
                    <label class="error" for="paypal_id">{{ $errors->first('paypal_id') }}</label>
                @endif
        </div>
-->
        <div class="form-group col-md-6">
            <label class="form-control-label">Facebook </label>
            <input type="text" class="form-control" name="link_facebook" 
               value="{{ $instructor->link_facebook }}" />
                @if ($errors->has('link_facebook'))
                    <label class="error" for="link_facebook">{{ $errors->first('link_facebook') }}</label>
                @endif
        </div>

        <div class="form-group col-md-6">
            <label class="form-control-label">Linkedin </label>
            <input type="text" class="form-control" name="link_linkedin" 
               value="{{ $instructor->link_linkedin }}" />
                @if ($errors->has('link_linkedin'))
                    <label class="error" for="link_linkedin">{{ $errors->first('link_linkedin') }}</label>
                @endif
        </div>
<!--
        <div class="form-group col-md-6">
            <label class="form-control-label">Twitter Link </label>
            <input type="text" class="form-control" name="link_twitter" 
                placeholder="Twitter Link" value="{{ $instructor->link_twitter }}" />
                @if ($errors->has('link_twitter'))
                    <label class="error" for="link_twitter">{{ $errors->first('link_twitter') }}</label>
                @endif
        </div>
-->
<!--
        <div class="form-group col-md-6">
            <label class="form-control-label">Google Plus Link </label>
            <input type="text" class="form-control" name="link_googleplus" 
                placeholder="Google Plus Link" value="{{ $instructor->link_googleplus }}" />
                @if ($errors->has('link_googleplus'))
                    <label class="error" for="link_googleplus">{{ $errors->first('link_googleplus') }}</label>
                @endif
        </div>
-->
        </div>

        <div class="row">
        	
    		<div class="form-group col-md-4">
	            <label class="form-control-label">Imagem</label>
	            
	            <label class="cabinet center-block">
	                <figure class="course-image-container">
	                    <i data-toggle="tooltip" data-original-title="Delete" data-id="course_image" class="fa fa-trash remove-lp" data-content="{{  Crypt::encryptString(json_encode(array('model'=>'courses', 'field'=>'course_image', 'pid' => 'id', 'id' => $instructor->id, 'photo'=>$instructor->instructor_image))) }}" style="display: @if(Storage::exists($instructor->instructor_image)){{ 'block' }} @else {{ 'none' }} @endif"></i>
	                    <img src="@if(Storage::exists($instructor->instructor_image)){{ Storage::url($instructor->instructor_image) }}@else{{ asset('backend/assets/images/course_detail.jpg') }}@endif" class="gambar img-responsive" id="course_image-output" name="course_image-output" />
	                	<input type="file" class="item-img file center-block" name="course_image" id="course_image" />
	                </figure>
                    <span style="font-size: 10px;">
                   Formatos Suportados: jpg,jpeg,png 
                    <br>Dimensões: 258px X 172px
                    <br> Tamanho Máximo: 1MB
                </span>
	            </label>
	            <input type="hidden" name="course_image_base64" id="course_image_base64">
                
	        </div>

	        <div class="form-group col-md-8">
	            <label class="form-control-label">Sobre <span class="required">*</span></label>
	            <textarea id="biography" name="biography">
	                {{ $instructor->biography }}
	            </textarea>
                @if ($errors->has('biography'))
                    <label class="error" for="biography">{{ $errors->first('biography') }}</label>
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

<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar foto</h4>
            </div>
            <div class="modal-body">
                <div id="upload-demo" class="center-block"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary">Cortar</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('javascript')
<script type="text/javascript">

    $(document).ready(function()
    { 
        //image crop start
        $(".gambar").attr("src", @if(Storage::exists($instructor->instructor_image))"{{ Storage::url($instructor->instructor_image) }}" @else "{{ asset('backend/assets/images/course_detail.jpg') }}" @endif);

        var $uploadCrop,
        tempFilename,
        rawImg,
        imageId;

        function readFile(input, id) {    
            
            var file_name = input.files[0].name;
            var extension = (input.files[0].name).split('.').pop();
            var allowed_extensions = ["jpg", "jpeg", "png"];
            var fsize = input.files[0].size;
            toastr.options.closeButton = true;
            toastr.options.timeOut = 5000;

            if (input.files && input.files[0]) {

                if ($.inArray(extension, allowed_extensions) == -1) {
                    toastr.error("Formato de imagem inválido");
                    return false;
                } else if(fsize > 1048576) {
                    toastr.error("Imagem com tamanho maior que o permitido");
                    return false;
                } 
                $('.input-group-file input').attr('value', file_name);
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');

                    $('#cropImageBtn').attr('data-id', id);

                    $('#cropImagePop').modal('show');
                    rawImg = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 558,
                height: 372,
            },
            enforceBoundary: true,
            enableExif: true
        });

        $('#cropImagePop').on('shown.bs.modal', function(){
            // alert('Shown pop');
            $uploadCrop.croppie('bind', {
                url: rawImg
            }).then(function(){
                console.log('jQuery bind complete');
            });
        });

        $('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
         readFile(this, $(this).attr('id')); });
        $('#cropImageBtn').on('click', function (ev) {
            var data_id = $(this).attr('data-id');
            $uploadCrop.croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {width: 258, height: 172}
            }).then(function (resp) {
                $("#"+data_id+"_base64").val(resp);
                $("#"+data_id+"-output").attr("src", resp);
                $("#cropImagePop").modal("hide");
            });
        });
        //image crop end

        $('.remove-lp').click(function(event)
        {
            event.preventDefault();
            var this_id = $(this);
            var current_id = $(this).attr('data-id');

            alertify.confirm('Tem certeza de que deseja excluir esta imagem?', function () {
                var url = "{{ url('delete-photo') }}";
                var data_content = this_id.attr('data-content');
                 $.ajax({
                    type: "POST",
                    url: url,
                    data: {data_content: data_content, _token: "{{ csrf_token() }}"},
                    success: function (data) {
                        $("#"+current_id+"-output").attr("src", "{{ asset('backend/assets/images/course_detail.jpg') }}");
                        this_id.hide();
                    }
                });
            }, function () {    
                return false;
            });

            
        });

        tinymce.init({ 
            entity_encoding: "raw",
            selector:'textarea',
            menubar:false,
            statusbar: false,
            height: 280,
            content_style: "#tinymce p{color:#414146;}"
        });

       
        $("#profileForm").validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    contact_email:{
                        required: true,
                        email:true
                    },
                    telephone: {
                        required: true
                    },
                    paypal_id:{
                        required: true,
                        email:true
                    },
                    biography: {
                        required: true
                    },
                },
                messages: {
                    first_name: {
                        required: 'Este campo é obrigatório.'
                    },
                    last_name: {
                        required: 'Este campo é obrigatório.'
                    },
                    contact_email: {
                        required: 'Este campo é obrigatório.',
                        email: 'Informe um endereço de e-mail válido.'
                    },
                    telephone: {
                        required: 'Este campo é obrigatório.'
                    },
                    biography: {
                        required: 'Este campo é obrigatório.'
                    },
                }
            });
	});
</script>
@endsection