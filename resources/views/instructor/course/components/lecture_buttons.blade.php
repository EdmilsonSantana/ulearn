<div class="lecture_buttons">
    <div class="lecture_edit_content" id="lecture_edit_content{!! $lecturequiz->lecture_quiz_id !!}">
        <input type="button" name="lecture_edit_content" class="btn editlectcontent btn-secondary" value="{!! Lang::get('curriculum.Edit_Content')!!}" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}" data-alt="{{$media_type}}">
        @if(empty($lecturequiz->description))
        <input type="button" name="lecture_add_content" class="btn btn-primary adddescription" value="{!! Lang::get('curriculum.Add_Description')!!}" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}">
        @endif
        <!--<input type="button" name="lecture_resource_content" class="btn btn-info addresource" value="{!! Lang::get('curriculum.Add_Resource')!!}" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}" data-alt="resource"> -->
        @if($lecturequiz->publish == 0)
        <input type="button" name="lecture_publish_content" class="btn btn-warning publishcontent" value="{!! Lang::get('curriculum.Publish')!!}" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}">
        @else
        <input type="button" name="lecture_unpublish_content" class="btn btn-danger unpublishcontent" value="{!! Lang::get('curriculum.Unpublish')!!}" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}">
        @endif
    </div>
</div>