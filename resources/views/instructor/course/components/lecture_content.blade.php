@php
use App\Library\ulearnHelpers;
@endphp

<li class="lq_sort su_lgray_curr childli lecture-{!! $lecturequiz->lecture_quiz_id !!} lecture parent-s-{!! $section->section_id !!}">
    <div class="row-fluid sorthandle">
        <div class="col col-lg-12">
            <div class="su_course_lecture_label @if(!is_null($lecturequiz->media_type) && $lecturequiz->publish == 0) su_orange_curr_block @elseif(!is_null($lecturequiz->media_type) && $lecturequiz->publish == 1) su_green_curr_block @else su_lgray_curr_block @endif">
                <div class="edit_option edit_option_lecture">{!! Lang::get('curriculum.Lecture')!!} <span class="serialno">{!! $lecturecount !!}</span>: <label class="slqtitle">{!! $lecturequiz->title !!}</label>
                    <input type="text" class="su_course_update_lecture_textbox chcountfield" value="{!! $lecturequiz->title !!}" maxlength="80">
                    <span class="ch-count">{!! 80-strlen($lecturequiz->title) !!}</span>
                </div>
                <i class="fa fa-edit btn-edit-title"></i>
                <input type="hidden" value="{!! $lecturequiz->lecture_quiz_id !!}" class="lectureid" name="lectureids[]">
                <input type="hidden" value="{!! $lecturequiz->sort_order !!}" class="lecturepos" name="lectureposition[]">
                <input type="hidden" value="{!! $section->section_id !!}" class="lecturesectionid" name="lecturesectionid">
                <div class="lecture_add_content" id="lecture_add_content{!! $lecturequiz->lecture_quiz_id !!}">
                    @php
                    $has_empty_content = empty($lecturequiz->media) && is_null($lecturequiz->media_type);
                    @endphp
                    @if($has_empty_content)
                    <input type="button" name="lecture_add_content" value="{!! Lang::get('curriculum.Add_Content')!!}" class="addcontents" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}">
                    @endif
                    <div class="closeheader">
                        <span class="closetext"></span>
                        <input type="button" name="lecture_close_content" value="X" class="btn-danger closecontents closebtn" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}">
                    </div>
                </div>
                <div class="deletelecture" style="{{ $has_empty_content ? 'display:none' : '' }}" onclick="deletelecture({!! $lecturequiz->lecture_quiz_id !!},{!! $section->section_id !!})"><i class="fa fa-trash"></i></div>
                <div class="updatelecture" onclick="updatelecture({!! $lecturequiz->lecture_quiz_id !!},{!! $section->section_id !!})"><i class="fa fa-check"></i></div>
            </div>
        </div>
    </div>


    <!-- add contents block start -->

    <div class="lecturepopup hideit" id="wholeblock-{!! $lecturequiz->lecture_quiz_id !!}">
        <div class="lecturecontent">
            <div class="lecture-media">
                <div class="clearfix">
                    <div class="divli lmedia-video" data-lid="{!! $lecturequiz->lecture_quiz_id !!}"  alt="video"><div class="lecturemedia"><span>{!! Lang::get('curriculum.Video')!!}</span></div><label>{!! Lang::get('curriculum.Video')!!}</label><div class="innershadow"></div></div>
                    <div class="divli lmedia-audio" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" alt="audio"><div class="lecturemedia"><span>{!! Lang::get('curriculum.Audio')!!}</span></div><label>{!! Lang::get('curriculum.Audio')!!}</label><div class="innershadow"></div></div>
                    <div class="divli lmedia-file" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" alt="file"><div class="lecturemedia"><span>{!! Lang::get('curriculum.Document')!!}</span></div><label>{!! Lang::get('curriculum.Document')!!}</label><div class="innershadow"></div></div>
                    <div class="divli lmedia-text" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" alt="text"><div class="lecturemedia"><span>{!! Lang::get('curriculum.Text')!!}</span></div><label>{!! Lang::get('curriculum.Text')!!}</label><div class="innershadow"></div></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add contents block end -->


    <!-- add video start -->
    <div class="lecturepopup @if(empty($lecturequiz->media)) @if($lecturequiz->media_type != 3) hideit @endif @endif" id="contentpopshow{!! $lecturequiz->lecture_quiz_id !!}">
        <div class="lecturecontent_inner ltwovideo">
            <div class="lecturecontent_video lecturecontent_tab">
                <div class="lecturecontent_video_content lecturecontent_tab_content">
                    <div id="uploadvideo{!! $lecturequiz->lecture_quiz_id !!}" class="uploadvideo" style="display: block;">

                        <div class="cccontainer" id="cccontainer{!! $lecturequiz->lecture_quiz_id !!}">

                            <div class="cctabs" id="cctabs{!! $lecturequiz->lecture_quiz_id !!}">
                                <div class="cctab-link current" data-cc="1" data-tab="{!! $lecturequiz->lecture_quiz_id !!}" id="upfiletab{!! $lecturequiz->lecture_quiz_id !!}">{!! Lang::get('curriculum.Upload_File')!!}</div>
                                <div class="cctab-link" data-cc="2" data-tab="{!! $lecturequiz->lecture_quiz_id !!}" id="fromlibrarytab{!! $lecturequiz->lecture_quiz_id !!}">{!! Lang::get('curriculum.Library')!!}</div>
                                <div class="cctab-link" data-cc="3" data-tab="{!! $lecturequiz->lecture_quiz_id !!}" id="externalrestab{!! $lecturequiz->lecture_quiz_id !!}" style="display:none;">{!! Lang::get('curriculum.resource')!!}</div>
                            </div>

                            <div id="upfile{!! $lecturequiz->lecture_quiz_id !!}" class="cctab-content current">
                                <div class="row-fluid @if(!empty($lecturequiz->media) || !empty($lecturequiz->contenttext)) hideit @endif" id="wholevideos{!! $lecturequiz->lecture_quiz_id !!}">
                                    <div class="col col-lg-8" id="allbar{!! $lecturequiz->lecture_quiz_id !!}" style="display:none;">
                                        <input type="hidden" id="probar_status_{!! $lecturequiz->lecture_quiz_id !!}" value="0" />
                                        <div class="luploadvideo-progressbar meter">
                                            <div class="bar" id="probar{!! $lecturequiz->lecture_quiz_id !!}" style="width:0%"></div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-4">

                                        <div class="luploadvideo" id="videosfiles-{!! $lecturequiz->lecture_quiz_id !!}" style="display:none;"> <input id="luploadvideo" class="videofiles" type="file" name="lecturevideo" data-url="{!! url('courses/lecturevideo/save/'.$lecturequiz->lecture_quiz_id) !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}"><span>{!! Lang::get('curriculum.use_lecture_video')!!}</span></div>

                                        <div class="luploadvideo" id="audiofiles-{!! $lecturequiz->lecture_quiz_id !!}" style="display:none;">
                                            <input id="luploadaudio" class="audiofiles luploadbtn" type="file" name="lectureaudio" data-url="{!! url('courses/lectureaudio/save/'.$lecturequiz->lecture_quiz_id) !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                                            <span>{!! Lang::get('curriculum.curriculum_upload')!!}</span>
                                        </div>
                                        <div class="luploadvideo" id="prefiles-{!! $lecturequiz->lecture_quiz_id !!}" style="display:none;">
                                            <input id="luploadpre" class="prefiles luploadbtn" type="file" name="lecturepre" data-url="{!! url('courses/lecturepre/save/'.$lecturequiz->lecture_quiz_id) !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                                            <span>{!! Lang::get('curriculum.curriculum_pdf')!!}</span>
                                        </div>
                                        <div class="luploadvideo" id="docfiles-{!! $lecturequiz->lecture_quiz_id !!}" style="display:none;">
                                            <input id="luploaddoc" class="docfiles luploadbtn" type="file" name="lecturedoc" data-url="{!! url('courses/lecturedoc/save/'.$lecturequiz->lecture_quiz_id) !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                                            <span>{!! Lang::get('curriculum.curriculum_pdfdoc')!!}</span>
                                        </div>
                                        <div class="luploadvideo" id="resfiles-{!! $lecturequiz->lecture_quiz_id !!}" style="display:none;">
                                            <input id="luploadres" class="resfiles luploadbtn" type="file" name="lectureres" data-url="{!! url('courses/lectureres/save/'.$lecturequiz->lecture_quiz_id) !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                                            <span>{!! Lang::get('curriculum.curriculum_doc')!!}</span>
                                        </div>
                                    </div>
                                    <div class="col col-lg-12">
                                        <div class="width100" id="textdescfiles-{!! $lecturequiz->lecture_quiz_id !!}" style="display:none;">
                                            <textarea name="textdescription" id="textdesc-{!! $lecturequiz->lecture_quiz_id !!}" class="form-control curricullamEditor"></textarea>
                                            <input type="button" name="textsave" value="{!! Lang::get('curriculum.sb_save')!!}" class="btn btn-primary savedesctext" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                                            <input type="button" name="canceldesctext" value="{!! Lang::get('curriculum.cancel')!!}" class="btn btn-secondary canceldesctext" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                                        </div>


                                    </div>
                                    <div class="clear"></div>
                                    <!-- <div class="col col-lg-12 buttongreen30"> <input type="button" class="change_media_btn" value="Change Media" onclick="deletemedia(692)"></div> -->
                                </div>
                            </div>
                            <div id="fromlibrary{!! $lecturequiz->lecture_quiz_id !!}" class="cctab-content">

                                <div class="cvideofiles" id="cvideofiles{!! $lecturequiz->lecture_quiz_id !!}">
                                    @if(isset($uservideos) && !empty($uservideos))
                                    @foreach($uservideos as $video)
                                    <div class="cclickable updatelibcontent" id="cvideos{!! $lecturequiz->lecture_quiz_id !!}_{!! $video->id !!}" data-type="video" data-alt="0" data-lib="{!! $video->id !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}"><i class="fa fa-play-circle-o"></i> {!! $video->video_name !!} ({!! $video->duration !!})
                                        <!--div class="goright cvideodelete" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" data-rid="{!! $video->id !!}"><i class="goright fa fa-trash-o"></i></div-->
                                    </div>
                                    @endforeach
                                    @else
                                    <center><em>{!! Lang::get('curriculum.no_library')!!}</em></center>
                                    @endif
                                </div>

                                <div class="caudiofiles" id="caudiofiles{!! $lecturequiz->lecture_quiz_id !!}">
                                    @if(isset($useraudios) && !empty($useraudios))
                                    @foreach($useraudios as $audio)
                                    <div class="cclickable updatelibcontent" id="caudios{!! $lecturequiz->lecture_quiz_id !!}_{!! $audio->id !!}" data-type="audio" data-alt="1" data-lib="{!! $audio->id !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}"><i class="fa fa-volume-up"></i> {!! $audio->file_title !!} ({!! $audio->duration !!})
                                        <!--div class="goright caudiodelete" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" data-rid="{!! $audio->id !!}"><i class="goright fa fa-trash-o"></i></div-->
                                    </div>
                                    @endforeach
                                    @else
                                    <center><em>{!! Lang::get('curriculum.no_library')!!}</em></center>
                                    @endif
                                </div>

                                <div class="cprefiles" id="cprefiles{!! $lecturequiz->lecture_quiz_id !!}">
                                    @if(isset($userpresentation) && !empty($userpresentation))
                                    @foreach($userpresentation as $presentation)
                                    <div class="cclickable updatelibcontent" id="cpres{!! $lecturequiz->lecture_quiz_id !!}_{!! $presentation->id !!}" data-type="presentation" data-alt="5" data-lib="{!! $presentation->id !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}"><i class="fa fa-picture-o"></i> {!! $presentation->file_title !!} ({!! ulearnHelpers::HumanFileSize($presentation->file_size) !!})
                                        <!--div class="goright cpredelete" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" data-rid="{!! $presentation->id !!}"><i class="goright fa fa-trash-o"></i></div-->
                                    </div>
                                    @endforeach
                                    @else
                                    <center><em>{!! Lang::get('curriculum.no_library')!!}</em></center>
                                    @endif
                                </div>

                                <div class="cdocfiles" id="cdocfiles{!! $lecturequiz->lecture_quiz_id !!}">
                                    @if(isset($userdocuments) && !empty($userdocuments))
                                    @foreach($userdocuments as $document)
                                    <div class="cclickable updatelibcontent" id="cdocs{!! $lecturequiz->lecture_quiz_id !!}_{!! $document->id !!}" data-type="file" data-alt="2" data-lib="{!! $document->id !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}"><i class="fa fa-file-text-o"></i> {!! $document->file_title !!} ({!! ulearnHelpers::HumanFileSize($document->file_size) !!})
                                        <!--div class="goright cdocdelete" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" data-rid="{!! $document->id !!}"><i class="goright fa fa-trash-o"></i></div-->
                                    </div>
                                    @endforeach
                                    @else
                                    <center><em>{!! Lang::get('curriculum.no_library')!!}</em></center>
                                    @endif
                                </div>

                                <div class="cresfiles" id="cresfiles{!! $lecturequiz->lecture_quiz_id !!}">
                                    @if(isset($userresources) && !empty($userresources))
                                    @foreach($userresources as $resource)
                                    <div class="cclickable updaterescontent" id="cresources{!! $lecturequiz->lecture_quiz_id !!}_{!! $resource->id !!}" data-lib="{!! $resource->id !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}"><i class="fa fa-file-text"></i> {!! $resource->file_title !!} ({!! ulearnHelpers::HumanFileSize($resource->file_size) !!})
                                        <!--div class="goright cresdelete" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" data-rid="{!! $resource->id !!}"><i class="goright fa fa-trash-o"></i></div-->
                                    </div>
                                    @endforeach
                                    @else
                                    <center><em>{!! Lang::get('curriculum.no_library')!!}</em></center>
                                    @endif
                                </div>

                            </div>
                            <div id="externalres{!! $lecturequiz->lecture_quiz_id !!}" class="cctab-content">

                                <div class="form-group">
                                    <label for="label" class="col-xs-12">
                                        <p><strong>{!! Lang::get('curriculum.Title')!!}</strong></p>
                                    </label>
                                    <div class="col-xs-12">
                                        <div><input class="form-control" placeholder="A Descriptive Title" id="exres_title{!! $lecturequiz->lecture_quiz_id !!}" name="exres_title" type="text" value=""></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="label" class="col-xs-12">
                                        <p><strong> {!! Lang::get('curriculum.Link')!!}</strong></p>
                                    </label>
                                    <div class="col-xs-12">
                                        <div><input class="form-control" placeholder="http://www.sample.com" id="exres_link{!! $lecturequiz->lecture_quiz_id !!}" name="exres_link" type="text" value=""></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div><input type="button" name="su_course_add_res_link_submit" value="{!! Lang::get('curriculum.Add_Link')!!}" class="btn btn-warning su_course_add_res_link_submit" data-lid="{!! $lecturequiz->lecture_quiz_id !!}"></div>
                                    </div>
                                </div>

                            </div>

                        </div>



                        <div class="tips" id="videoresponse{!! $lecturequiz->lecture_quiz_id !!}">
                            @if(!empty($lecturequiz->media) || !empty($lecturequiz->contenttext))

                            @if(isset($lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id]))


                            @if($lecturequiz->media_type == 0)
                                @include('instructor/course/components/media_video')
                            @elseif($lecturequiz->media_type == 1)
                                @include('instructor/course/components/media_audio')
                            @elseif($lecturequiz->media_type == 2)
                                @include('instructor/course/components/media_file')
                            @elseif($lecturequiz->media_type == 3)
                                @include('instructor/course/components/media_text', ['text' =>  $lecturesmedia[$section->section_id][$lecturequiz->lecture_quiz_id]])
                            @elseif($lecturequiz->media_type == 5)
                                @include('instructor/course/components/media_presentation')
                            @endif

                            @endif
                            @endif

                        </div>
                        <div id="resresponse{!! $lecturequiz->lecture_quiz_id !!}"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add video end -->

    <!-- add description start -->

    <div class="su_course_add_lecture_desc_content su_course_add_content_desc_form @if(empty($lecturequiz->description)) hideit editing @endif" id="adddescblock-{!! $lecturequiz->lecture_quiz_id !!}">
        <div class="divtitlehead">
            <p>{!! Lang::get('curriculum.Description')!!}</p>
        </div>
        <div class="formrow @if(empty($lecturequiz->description)) hideit @endif" id="descblock{!! $lecturequiz->lecture_quiz_id !!}">
            <div class="row-fluid">
                <div class="editdescription" id="descriptions{!! $lecturequiz->lecture_quiz_id !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">{!! $lecturequiz->description !!}</div>
            </div>
        </div>

        <div class="formrow @if(!empty($lecturequiz->description)) hideit @endif" id="editblock{!! $lecturequiz->lecture_quiz_id !!}">
            <div class="row-fluid">
                <!-- <div class="col col-lg-3"><label>Lecture Description: </label></div> -->
                <div class="col col-lg-12"><textarea name="lecturedescription" id="lecturedesc-{!! $lecturequiz->lecture_quiz_id !!}" class="form-control curricullamEditor"></textarea></div>
            </div>
        </div>

        <div class="formrow @if(!empty($lecturequiz->description)) hideit @endif" id="editblockfooter{!! $lecturequiz->lecture_quiz_id !!}">
            <div class="row-fluid">
                <div class="col col-lg-12">
                    <input type="button" name="su_course_add_lecture_desc_submit" value="{!! Lang::get('curriculum.sb_save')!!}" class="btn btn-primary su_course_add_lecture_desc_submit" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                    <input type="button" id="btn_description" name="su_course_add_lecture_desc_cancel" value="{!! Lang::get('curriculum.cancel')!!}" class="btn btn-secondary su_course_add_lecture_desc_cancel" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}"></div>
            </div>
        </div>

    </div>

    <!-- add description end -->

    <!-- list resources start -->
    <div class="su_course_add_lecture_desc_content @if(!isset($lecturesresources[$section->section_id][$lecturequiz->lecture_quiz_id])) hideit @endif" id="resourceblock{!! $lecturequiz->lecture_quiz_id !!}">
        <div class="divtitlehead">
            <p>{!! Lang::get('curriculum.Resources')!!}</p>
        </div>
        <div class="formrow">
            <div class="row-fluid resourcefiles">
                @if(isset($lecturesresources[$section->section_id][$lecturequiz->lecture_quiz_id]))
                @foreach($lecturesresources[$section->section_id][$lecturequiz->lecture_quiz_id] as $resources)
                @foreach($resources as $resource)
                <div id="resources{!! $lecturequiz->lecture_quiz_id !!}_{!! $resource->id !!}"> @if($resource->file_type == 'link') <i class="fa fa-external-link"></i> {!! $resource->file_title !!} @else <i class="fa fa-download"></i> {!! $resource->file_title !!} ({!! ulearnHelpers::HumanFileSize($resource->file_size) !!}) @endif <div class="goright resdelete" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" data-rid="{!! $resource->id !!}"><i class="goright fa fa-trash-o"></i></div>
                </div>
                @endforeach
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- list resources end -->
</li>