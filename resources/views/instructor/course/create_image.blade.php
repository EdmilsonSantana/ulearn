@extends('layouts.backend.index')
@section('content')
<style type="text/css">
    label.cabinet {
        display: block;
        cursor: pointer;
    }

    .cabinet.center-block {
        margin-bottom: -1rem;
    }

    #upload-demo {
        width: 558px;
        height: 372px;
        padding-bottom: 25px;
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

    .course-image-container {
        width: 435px;
        height: 290px;
        border: 1px solid #e4eaec;
        position: relative;
    }

    .course-image-container img {
        width: 399px;
        height: 266px;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }

    .remove-lp {
        font-size: 16px;
        color: red;
        float: right;
        padding-right: 2px;
    }
</style>

<div class="page-header">
    <h1 class="page-title">Adicionar Curso</h1>
</div>

<div class="page-content">

    <div class="panel">
        <div class="panel-body">


            @include('instructor/course/tabs')


            <form method="POST" action="{{ route('instructor.course.image.save') }}" class="register-form" id="courseForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <input type="hidden" name="old_course_image" value="{{ $course->course_image }}">
                <input type="hidden" name="old_thumb_image" value="{{ $course->thumb_image }}">
                <div class="row">

                    <div class="form-group col-md-6">
                        <!-- <label class="form-control-label">Course Image</label> -->

                        <label class="cabinet center-block">
                            <figure class="course-image-container">
                                <i data-toggle="tooltip" data-original-title="Delete" data-id="course_image" class="fa fa-trash remove-lp" data-content="{{  Crypt::encryptString(json_encode(array('model'=>'courses', 'field'=>'course_image', 'pid' => 'id', 'id' => $course->id, 'photo'=>$course->course_image))) }}" style="display: @if(Storage::disk('public')->exists($course->course_image)){{ 'block' }} @else {{ 'none' }} @endif"></i>
                                <img src="@if(Storage::disk('public')->exists($course->course_image)){{ Storage::disk('public')->url($course->course_image) }}@else{{ asset('backend/assets/images/course_detail.jpg') }}@endif" class="gambar img-responsive" id="course_image-output" name="course_image-output" />
                            </figure>
                        </label>
                    </div>

                    <div class="form-group col-md-6 pt-4">
                    @include('components/file_formats', ['type' => 'image'])

                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                    <input type="text" class="form-control" readonly="">
                                    <span class="input-group-btn">
                                        <span class="btn btn-success btn-file">
                                            <i class="icon wb-upload" aria-hidden="true"></i>
                                            <input type="file" class="item-img file center-block" name="course_image" id="course_image" />
                                            <input type="hidden" name="course_image_base64" id="course_image_base64">
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                @include('admin/components/button', ['type' => 'submit', 'primary' => 'true', 'text' => 'Salvar'])

                            </div>
                        </div>
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
                <h4 class="modal-title" id="myModalLabel">Editar Imagem</h4>
            </div>
            <div class="modal-body">
                <div id="upload-demo" class="center-block"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary">Recortar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        //image crop start
        $(".gambar").attr("src", 
            @if(Storage::disk('public')->exists($course->course_image))
            "{{ Storage::disk('public')->url($course->course_image) }}"
            @else 
            "{{ asset('backend/assets/images/course_detail.jpg') }}"
            @endif);

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
                } else if (fsize > 1048576 * 10) {
                    toastr.error("Imagem com tamanho maior que o permitido");
                    return false;
                }
                $('.input-group-file input').attr('value', file_name);
                var reader = new FileReader();
                reader.onload = function(e) {
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

        $('#cropImagePop').on('shown.bs.modal', function() {
            // alert('Shown pop');
            $uploadCrop.croppie('bind', {
                url: rawImg
            }).then(function() {
                console.log('jQuery bind complete');
            });
        });

        $('.item-img').on('change', function() {
            imageId = $(this).data('id');
            tempFilename = $(this).val();
            readFile(this, $(this).attr('id'));
        });
        $('#cropImageBtn').on('click', function(ev) {
            var data_id = $(this).attr('data-id');
            $uploadCrop.croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {
                    width: 825,
                    height: 550
                }
            }).then(function(resp) {
                $("#" + data_id + "_base64").val(resp);
                $("#" + data_id + "-output").attr("src", resp);
                $("#cropImagePop").modal("hide");
            });
        });
        //image crop end

        $(".tagsinput").tagsinput();


        $('.remove-lp').click(function(event) {
            event.preventDefault();
            var this_id = $(this);
            var current_id = $(this).attr('data-id');

            alertify.confirm('Tem certeza de que deseja excluir esta imagem ?', function() {
                var url = "{{ url('delete-photo') }}";
                var data_content = this_id.attr('data-content');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        data_content: data_content,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $("#" + current_id + "-output").attr("src", "{{ asset('backend/assets/images/course_detail.jpg') }}");
                        this_id.hide();
                    }
                });
            }, function() {
                return false;
            })


        });
    });
</script>
@endsection