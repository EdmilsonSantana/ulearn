@extends('layouts.backend.index')
@section('content')

@php
use App\Library\ulearnHelpers;
$course_id = $course->id;
@endphp
<link href="{{ asset('backend/curriculum/css/createcourse/style.css') }}" rel="stylesheet">

<div class="page-header">
  <h1 class="page-title">Adicionar Curso</h1>
</div>

<div class="page-content">

<div class="panel">
  <div class="panel-body">

    
    @include('instructor/course/tabs')
    
    <!-- curriculum start -->
    <div class="curriculam-block">
<div class="container">
  <div class="row">  
    
    
    <div class="col-md-12">

      <div class="lach_dev resp-tab-content course_tab"> 
        <div class="slider_divsblocks">
          
          <div class="form-group">
            <form method="POST" action="{{ 'course/updatecourse' }}" accept-charset="UTF-8" class="register-formform-horizontal saveLabel" parsley-validate="" novalidate=" " enctype="multipart/form-data">
            
             <input name="course_id" type="hidden" value="{{ $course->id }}">


            <input name="coursesection" type="hidden" value="{{ url('courses/section/save') }}">
            <input name="courselecture" type="hidden" value="{{ url('courses/lecture/save') }}">
            <input name="coursequiz" type="hidden" value="{{ url('courses/quiz/save') }}">
            <input name="coursecurriculumsort" type="hidden" value="{{ url('courses/curriculum/sort') }}">
            <input name="coursecurriculumquizquestionsort" type="hidden" value="{{ url('courses/curriculum/sortquiz') }}">
            <input name="coursesectiondel" type="hidden" value="{{ url('courses/section/delete') }}">
            <input name="courselecturequizdel" type="hidden" value="{{ url('courses/lecturequiz/delete') }}">
            <input name="courselecturedesc" type="hidden" value="{{ url('courses/lecturedesc/save') }}">
            <input name="courselecturepublish" type="hidden" value="{{ url('courses/lecturepublish/save') }}">
            <input name="courselecturevideo" type="hidden" value="{{ url('courses/lecturevideo/save') }}">
            <input name="courselecturetext" type="hidden" value="{{ url('courses/lecturetext/save') }}">
            <input name="courselectureres" type="hidden" value="{{ url('courses/lectureres/delete') }}">
            <input name="courseselectlibrary" type="hidden" value="{{ url('courses/lecturelib/save') }}">
            <input name="courseselectlibraryres" type="hidden" value="{{ url('courses/lecturelibres/save') }}">
            <input name="courseexternalres" type="hidden" value="{{ url('courses/lectureexres/save') }}">
            
            
            
            
            <div class="su_course_curriculam">

              <div class="su_course_curriculam_sortable">
                <ul class="clearfix ui-sortable">
                  @php $sectioncount = '1'; $lecturecount = '1'; $quizcount = '1'; @endphp
                  @foreach($sections as $section)

                  <li class="su_gray_curr parentli section-{!! $section->section_id !!}">
                    <div class="row-fluid sorthandle">
                      <div class="col col-lg-12">
                        <div class="su_course_section_label su_gray_curr_block">
                          <div class="edit_option edit_option_section">{!! Lang::get('curriculum.section')!!} <span class="serialno">{!! $sectioncount !!}</span>:<label class="slqtitle">{!! $section->title !!}</label>
                            <input type="text" maxlength="80" class="chcountfield su_course_update_section_textbox" @if($section->title == 'Seção '.$sectioncount) placeholder="{!! 'Seção '.$sectioncount !!}" value="" @else value="{!! $section->title !!}" @endif>
                            <span class="ch-count">@if($section->title == 'Seção '.$sectioncount) 80 @else{!! 80-strlen($section->title) !!}@endif</span>
                          </div>
                          <i class="fa fa-edit btn-edit-title"></i>
                          <input type="hidden" value="{!! $section->section_id !!}" class="sectionid" name="sectionids[]">
                          <input type="hidden" value="{!! $section->sort_order !!}" class="sectionpos" name="sectionposition[]">
                          <div class="deletesection" onclick="deletesection({!! $section->section_id !!})"><i class="fa fa-trash"></i></div>
                          <div class="updatesection" onclick="updatesection({!! $section->section_id !!})"><i class="fa fa-check"></i></div>
                        </div>
                      </div>
                    </div>
                  </li>

                  @if(isset($lecturesquiz[$section->section_id]))
                  @foreach($lecturesquiz[$section->section_id] as $lecturequiz)
                  @if($lecturequiz->type == 0)
  
                    @include('instructor/course/components/lecture_content')

                  @php $lecturecount++; @endphp
                  @elseif($lecturequiz->type == 1)
                  <li class="lq_sort_quiz su_lgray_curr quiz quiz-{!! $lecturequiz->lecture_quiz_id !!} parent-s-{!! $section->section_id !!}">
                    <div class="row-fluid sorthandle">
                      <div class="col col-lg-12">
                        <div class="su_course_quiz_label @if($lecturequiz->publish == 1) su_green_curr_block @else su_lgray_curr_block @endif">
                          <div class="edit_option edit_option_quiz">{!! Lang::get('curriculum.Quiz')!!} <span class="serialno">{!! $quizcount !!}</span>: <label class="slqtitle">{!! $lecturequiz->title !!}</label>
                            <input type="text" maxlength="80" class="chcountfield su_course_update_quiz_textbox" value="{!! $lecturequiz->title !!}">
                            <span class="ch-count">{!! 80-strlen($lecturequiz->title) !!}</span>
                          </div>
                          <input type="hidden" value="{!! $lecturequiz->lecture_quiz_id !!}" class="quizid" name="quizids[]">
                          <input type="hidden" value="{!! $lecturequiz->sort_order !!}" class="quizpos" name="quizposition[]">
                          <input type="hidden" value="{!! $section->section_id !!}" class="quizsectionid" name="quizsectionid">
                          <div class="deletequiz" onclick="deletequiz({!! $lecturequiz->lecture_quiz_id !!},{!! $section->section_id !!})"></div>
                          <div class="updatequiz" onclick="updatequiz({!! $lecturequiz->lecture_quiz_id !!},{!! $section->section_id !!})"></div>
                          <div class="lecture_add_content" id="lecture_add_quiz{!! $lecturequiz->lecture_quiz_id !!}">
                            <input type="button" name="lecture_add_quiz" value="Add Questions" class="addquestions" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}">
                            <div class="closeheader">
                              <span class="closetext"></span>
                              <input type="button" name="lecture_close_question" value="X" class="btn-danger closequestion" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <!-- list quiz questions start -->
                    <div class="su_course_add_lecture_desc_content @if(!isset($lecturesquizquestions[$section->section_id][$lecturequiz->lecture_quiz_id]) || empty($lecturesquizquestions[$section->section_id][$lecturequiz->lecture_quiz_id])) hideit nondata @endif" id="questionsblock{!! $lecturequiz->lecture_quiz_id !!}">
                      <div class="lecture_buttons lecture_edit_content">
                        @if($lecturequiz->publish == 0)
                        <input type="button" name="lecture_publish_content_quiz" class="btn btn-warning publishcontentquiz" value="{!! Lang::get('curriculum.Publish')!!}" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}">
                        @else
                        <input type="button" name="lecture_unpublish_content_quiz" class="btn btn-danger unpublishcontentquiz" value="{!! Lang::get('curriculum.Unpublish')!!}" data-blockid="{!! $lecturequiz->lecture_quiz_id !!}">
                        @endif
                      </div>
                      <div class="divtitlehead"><p><strong>{!! Lang::get('curriculum.Questions')!!}</strong></p></div>
                      <div class="formrow questionlist">
                        <div class="row-fluid quizquestions" id="quizquestions{!! $lecturequiz->lecture_quiz_id !!}" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                          @if(isset($lecturesquizquestions[$section->section_id][$lecturequiz->lecture_quiz_id]))
                          @php $quescount=1; @endphp
                          @foreach($lecturesquizquestions[$section->section_id][$lecturequiz->lecture_quiz_id] as $question)
                          <div class="quescount" id="questions{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}"> @if($question->question_type == '0') <i class="fa fa-list"></i>  @else <i class="fa fa-check"></i> @endif <span id="quescount{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}">{!! $quescount !!}</span>. {!! substr(strip_tags($question->question), 0, 56) !!}  <div class="goright quessort" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" data-rid="{!! $question->quiz_question_id !!}"><i class="goright fa fa-align-justify"></i></div><div class="goright quesdelete" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" data-rid="{!! $question->quiz_question_id !!}"><i class="goright fa fa-trash-o"></i></div> <div class="goright quesedit" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" data-rid="{!! $question->quiz_question_id !!}" data-ltype="{!! $question->question_type !!}"><i class="goright fa fa-pencil"></i></div> <input type="hidden" value="{!! $question->quiz_question_id !!}" class="quizquestionid"></div>
                          @php $quescount++; @endphp
                          @endforeach
                          @endif
                        </div>
                      </div>
                    </div>
                    <!-- list quiz questions end -->

                    <!-- add question block start -->
                    <div class="lecturepopup hideit" id="quesblock-{!! $lecturequiz->lecture_quiz_id !!}">
                      <div class="quizques">
                        <div class="quiz-type">
                          <div class="clearfix">
                            <div class="divli lquiz-multiple" data-lid="{!! $lecturequiz->lecture_quiz_id !!}"  alt="multiple"><div class="quiztype"><span>{!! Lang::get('curriculum.Multiple Choice')!!}</span></div><label>{!! Lang::get('curriculum.Multiple_Choice')!!}</label><div class="innershadowquiz"></div></div>
                            <div class="divli lquiz-truefalse" data-lid="{!! $lecturequiz->lecture_quiz_id !!}"  alt="truefalse"><div class="quiztype"><span>{!! Lang::get('curriculum.true_false')!!}</span></div><label>{!! Lang::get('curriculum.true_false')!!}</label><div class="innershadowquiz"></div></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Add question block end -->

                    <!-- Question content -->
                    <div class="lecturepopup hideit" id="contentques-{!! $lecturequiz->lecture_quiz_id !!}">
                      <div class="quizques">
                        <div class="divtitlehead"><p><strong>{!! Lang::get('curriculum.Questions')!!}</strong></p></div>
                        
                        <div class="formrow margbot">
                          <div class="row-fluid">
                            <div><textarea name="quizquestion" id="quizquestion-{!! $lecturequiz->lecture_quiz_id !!}" class="form-control curricullamEditor"></textarea></div>
                          </div>
                        </div>
                        
                        <div class="divtitlehead"><p><strong>{!! Lang::get('curriculum.Answers')!!}</strong></p></div>
                        <div class="qmultiple hideit" id="multipleques-{!! $lecturequiz->lecture_quiz_id !!}">
                          <div class="divtitlesub"><p>{!! Lang::get('curriculum.ans_writeup')!!}</p></div>
                          <div class="qanswer">
                            <div class="col col-lg-12">
                              <input type="radio" name="answers-radio{!! $lecturequiz->lecture_quiz_id !!}" value="1">
                              <input type="text" placeholder="{!! Lang::get('curriculum.Add_an_answer')!!}" class="chcountfield count600 answer" maxlength="600" name="answers[]" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                              <span class="answers-counter ch-count">600</span>
                            </div>
                            <div class="col col-lg-12">
                              <input type="text" placeholder="{!! Lang::get('curriculum.best_answer')!!}" class="chcountfield count600 answer-feedback" maxlength="600" name="answersfeedback[]">
                              <span class="answers-feedback-counter ch-count">600</span>
                            </div>
                          </div>
                          <div class="qanswer">
                            <div class="col col-lg-12">
                              <input type="radio" name="answers-radio{!! $lecturequiz->lecture_quiz_id !!}" value="2">
                              <input type="text" placeholder="{!! Lang::get('curriculum.Add_an_answer')!!}" class="chcountfield count600 answer" maxlength="600" name="answers[]" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                              <span class="answers-counter ch-count">600</span>
                            </div>
                            <div class="col col-lg-12">
                              <input type="text" placeholder="{!! Lang::get('curriculum.best_answer')!!}" class="chcountfield count600 answer-feedback" maxlength="600" name="answersfeedback[]">
                              <span class="answers-feedback-counter ch-count">600</span>
                            </div>
                          </div>
                          <div class="qanswer">
                            <div class="col col-lg-12">
                              <div class="delques"><i class="fa fa-trash-o"></i></div>
                              <input type="radio" name="answers-radio{!! $lecturequiz->lecture_quiz_id !!}" value="3">
                              <input type="text" placeholder="{!! Lang::get('curriculum.Add_an_answer')!!}" class="chcountfield count600 qlastchild answer" maxlength="600" name="answers[]" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                              <span class="answers-counter ch-count">600</span>
                            </div>
                            <div class="col col-lg-12">
                              <input type="text" placeholder="{!! Lang::get('curriculum.best_answer')!!}" class="chcountfield count600 answer-feedback" maxlength="600" name="answersfeedback[]">
                              <span class="answers-feedback-counter ch-count">600</span>
                            </div>
                          </div>
                        </div>
                        
                        <div class="qtruefalse hideit" id="truefalseques-{!! $lecturequiz->lecture_quiz_id !!}">
                          <div class="divtitlesub"><p>{!! Lang::get('curriculum.quiz_msg')!!}</p></div>
                          <div class="formrow">
                            <div class="row-fluid">
                              <div class="col col-lg-2">
                                <input type="radio" id="radtrue{!! $lecturequiz->lecture_quiz_id !!}" name="answers-radio{!! $lecturequiz->lecture_quiz_id !!}" value="1"> {!! Lang::get('curriculum.True')!!}
                              </div>
                              <div class="col col-lg-2">
                                <input type="radio" id="radfalse{!! $lecturequiz->lecture_quiz_id !!}" name="answers-radio{!! $lecturequiz->lecture_quiz_id !!}" value="2"> {!! Lang::get('curriculum.False')!!}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="formrow">
                          <div class="row-fluid">
                            <input type="button" name="su_course_add_quiz_question_submit" value="{!! Lang::get('curriculum.sb_save')!!}" class="btn btn-warning su_course_add_quiz_question_submit"  data-lid="{!! $lecturequiz->lecture_quiz_id !!}"> 
                            <input type="hidden" value="0" id="quiztype{!! $lecturequiz->lecture_quiz_id !!}">
                            <input type="hidden" value="0" id="coption{!! $lecturequiz->lecture_quiz_id !!}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Question content end -->

                    <!-- Question edit content -->
                    <div class="lecturepopup hideit editquestionpart" id="editquestionpart{!! $lecturequiz->lecture_quiz_id !!}">
                      @if(isset($lecturesquizquestions[$section->section_id][$lecturequiz->lecture_quiz_id]))
                      @foreach($lecturesquizquestions[$section->section_id][$lecturequiz->lecture_quiz_id] as $question)
                      <div class="contenteditques" id="contenteditques-{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}">
                        <div class="quizques">
                          <div class="divtitlehead"><p><strong>{!! Lang::get('curriculum.Questions')!!}</strong></p></div>
                          
                          <div class="formrow margbot">
                            <div class="row-fluid">
                              <div><textarea name="quizquestion" id="quizeditquestion-{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}" class="form-control curricullamEditor">{!! $question->question !!}</textarea></div>
                            </div>
                          </div>
                          
                          <div class="divtitlehead"><p><strong>{!! Lang::get('curriculum.Answers')!!}</strong></p></div>
                          @if($question->question_type == 0)
                          <div class="qmultiple" id="multipleeditques-{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}">
                            <div class="divtitlesub"><p>{!! Lang::get('curriculum.ans_writeup')!!}</p></div>
                            @php $quesanswers = json_decode($question->options); $anscount=1; $countans = count($quesanswers); @endphp
                            @foreach($quesanswers as $answer)
                            <div class="qanswer">
                              <div class="col col-lg-12">
                                @if($anscount > 2)
                                <div class="deleditques"><i class="fa fa-trash-o"></i></div>
                                @endif
                                <input type="radio" name="answers-radio{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}" value="{!! $anscount !!}" @if($anscount == $question->correct_option) checked="checked" @endif>
                                <input type="text" placeholder="{!! Lang::get('curriculum.Add_an_answer')!!}" class="chcountfield count600 answer" maxlength="600" name="answers[]" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" value="{!! $answer->answer !!}">
                                <span class="answers-counter ch-count">{!! 600-strlen($answer->answer) !!}</span>
                              </div>
                              <div class="col col-lg-12">
                                <input type="text" placeholder="{!! Lang::get('curriculum.best_answer')!!}" class="chcountfield count600 answer-feedback" maxlength="600" name="answersfeedback[]" value="{!! $answer->feedback !!}">
                                <span class="answers-feedback-counter ch-count">{!! 600-strlen($answer->feedback) !!}</span>
                              </div>
                            </div>
                            @php $anscount++; @endphp
                            @endforeach
                            <div class="qanswer">
                              <div class="col col-lg-12">
                                <div class="deleditques"><i class="fa fa-trash-o"></i></div>
                                <input type="radio" name="answers-radio{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}" value="{!! $countans+1 !!}">
                                <input type="text" placeholder="{!! Lang::get('curriculum.Add_an_answer')!!}" class="chcountfield count600 qlasteditchild answer" maxlength="600" name="answers[]" data-lid="{!! $lecturequiz->lecture_quiz_id !!}">
                                <span class="answers-counter ch-count">600</span>
                              </div>
                              <div class="col col-lg-12">
                                <input type="text" placeholder="{!! Lang::get('curriculum.best_answer')!!}" class="chcountfield count600 answer-feedback" maxlength="600" name="answersfeedback[]">
                                <span class="answers-feedback-counter ch-count">600</span>
                              </div>
                            </div>
                          </div>
                          @elseif($question->question_type == 1)
                          <div class="qtruefalse" id="truefalseeditques-{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}">
                            <div class="divtitlesub"><p>{!! Lang::get('curriculum.quiz_msg')!!}</p></div>
                            <div class="formrow">
                              <div class="row-fluid">
                                <div class="col col-lg-2">
                                  <input type="radio" id="radtrue{!! $lecturequiz->lecture_quiz_id !!}" name="answers-radio{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}" value="1" @if(1 == $question->correct_option) checked="checked" @endif> {!! Lang::get('curriculum.True')!!}
                                </div>
                                <div class="col col-lg-2">
                                  <input type="radio" id="radfalse{!! $lecturequiz->lecture_quiz_id !!}" name="answers-radio{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}" value="2" @if(2 == $question->correct_option) checked="checked" @endif> {!! Lang::get('curriculum.False')!!}
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif
                          <div class="formrow">
                            <div class="row-fluid">
                              <input type="button" name="su_course_add_quiz_question_update" value="{!! Lang::get('curriculum.sb_save')!!}" class="btn btn-warning su_course_add_quiz_question_update" data-lid="{!! $lecturequiz->lecture_quiz_id !!}" data-qid="{!! $question->quiz_question_id !!}"> 
                              <input type="hidden" value="{!! $question->question_type !!}" id="quiztype{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}">
                              <input type="hidden" value="{!! $question->correct_option !!}" id="coption{!! $lecturequiz->lecture_quiz_id !!}_{!! $question->quiz_question_id !!}">
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      @endif
                    </div>
                    <!-- Question edit content end -->
                    
                    <div class="su_course_add_lecture_desc_content quizeditdesc" id="quizeditdesc{!! $lecturequiz->lecture_quiz_id !!}">
                      <div class="divtitlehead"><p><strong> {!! Lang::get('curriculum.Description')!!}</strong></p></div>
                      <textarea name="lectureeditdescription" id="lectureeditdesc-{!! $lecturequiz->lecture_quiz_id !!}" class="form-control curricullamEditor"></textarea>
                      <div class="quizeditdescription" id="quizeditdescription{!! $lecturequiz->lecture_quiz_id !!}">{!! $lecturequiz->description !!}</div>
                    </div>
                    
                  </li>
                  @php $quizcount++; @endphp
                  @endif
                  @endforeach
                  @endif
                  
                  @php $sectioncount++; @endphp
                  @endforeach
                </ul>
              </div>

              <div class="su_course_curriculam_default">
                <ul class="clearfix">
                  <li class="su_blue_curr">
                    <div class="col col-lg-12">
                      <div class="row-fluid add_quiz_lecture_part">
                        <div class="col col-lg-6">
                          <div class="su_course_add_lecture_label su_blue_curr_block">
                            <span> {!! Lang::get('curriculum.Add_Lecture')!!}</span>
                          </div>
                        </div>
                        
                      </div>

                      <div class="su_course_add_lecture_content su_course_add_content_form">
                        <div class="formrow">
                          <div class="row-fluid">
                            <div class="col col-lg-3">
                              <label>{!! Lang::get('curriculum.New_Lecture')!!} <span class="text-danger">*</span></label>
                            </div>
                            <div class="col col-lg-9">
                              <input type="text" id="new_lecture" name="su_course_add_lecture_textbox" value="" placeholder="{!! Lang::get('curriculum.quiz_title')!!}" class="form-element su_course_add_lecture_textbox chcountfield" maxlength="80">
                              <span id="lecture_title_counter" class="ch-count">80</span>
                            </div>
                          </div>
                        </div>
                        <div class="formrow">
                          <div class="row-fluid">
                            <div class="col col-lg-9">
                              <input type="button" name="su_course_add_lecture_submit" value="{!! Lang::get('curriculum.Add_Lecture')!!}" class="btn btn-primary su_course_add_lecture_submit">
                              <input type="button" id="btn_lecture" name="su_course_add_lecture_cancel" value="{!! Lang::get('curriculum.cancel')!!}" class="btn btn-secondary su_course_add_lecture_cancel">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="su_course_add_quiz_content su_course_add_content_form su_course_add_quiz_form">
                        <div class="formrow">
                          <div class="row-fluid">
                            <div class="col col-lg-3">
                              <label>{!! Lang::get('curriculum.New_Quiz')!!}: <span class="text-danger">*</span></label>
                            </div>
                            <div class="col col-lg-9">
                              <input type="text" id="new_quiz" name="su_course_add_quiz_textbox" value="" placeholder="{!! Lang::get('curriculum.quiz_title')!!}" class="form-element su_course_add_quiz_textbox chcountfield" maxlength="80">
                              <span id="quiz_title_counter" class="ch-count">80</span>
                            </div>
                          </div>
                        </div>
                        <div class="formrow">
                          <div class="row-fluid">
                            <div class="col col-lg-3">
                              <label> {!! Lang::get('curriculum.Description')!!}: <span class="text-danger">*</span></label>
                            </div>
                            <div class="col col-lg-9">
                              <div><textarea name="quizdescription" id="quizdesc" class="form-control curricullamEditor su_course_add_quiz_desc"></textarea></div>
                            </div>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="formrow">
                          <div class="row-fluid">
                            <div class="col col-lg-9">
                              <input type="button" name="su_course_add_quiz_submit" value=" {!! Lang::get('curriculum.Add_Quiz')!!}" class="btn btn-warning su_course_add_quiz_submit">
                              <input type="button" id="btn_quiz" name="su_course_add_quiz_cancel" value=" {!! Lang::get('curriculum.cancel')!!}" class="btn btn-warning su_course_add_quiz_cancel">
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </li>

                  <li class="su_gray_curr">
                    <div class="row-fluid">
                      <div class="col col-lg-12">
                        <div class="su_course_add_section_label su_gray_curr_block">
                          <span> {!! Lang::get('curriculum.Add_Section')!!}</span>
                        </div>

                        <div class="su_course_add_section_content su_course_add_content_form">
                          <div class="formrow">
                            <div class="row-fluid">
                              <div class="col col-lg-3">
                                <label>{!! Lang::get('curriculum.New_Section')!!} <span class="text-danger">*</span></label>
                              </div>
                              <div class="col col-lg-9">
                                <input type="text" id="new_section" name="su_course_add_section_textbox" value="" placeholder="{!! Lang::get('curriculum.quiz_title')!!}" class="form-element su_course_add_section_textbox chcountfield" maxlength="80">
                                <span id="section_title_counter" class="ch-count">80</span>
                              </div>
                            </div>
                          </div>
                          <div class="formrow">
                            <div class="row-fluid">
                              <div class="col col-lg-9">
                                <input type="button" name="su_course_add_section_submit" value="{!! Lang::get('curriculum.Add_Section')!!}" class="btn btn-primary su_course_add_section_submit">
                                <input type="button" id="btn_section" name="su_course_add_section_cancel" value="{!! Lang::get('curriculum.cancel')!!}" class="btn btn-secondary su_course_add_section_cancel">
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </li>


                </ul>
              </div>

            </div>

            </form>


          </div>
        </div>
      </div> 

    </div>

  </div>
</div>
</div>
    <!-- curriculum end -->
    
  </div>
</div>

       
      <!-- End Panel Basic -->
</div>

@endsection

@section('javascript')

<script type="text/javascript" src="{{ asset('backend/curriculum/js/plugins/tinymce/jscripts/tiny_mce/tiny_mce.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/curriculum/js/plugins/fileupload/jquery.ui.widget.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/curriculum/js/plugins/fileupload/jquery.fileupload.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/curriculum/js/plugins/fileupload/jquery.fileupload-process.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/curriculum/js/plugins/fileupload/jquery.fileupload-validate.js') }}"></script>

<script type="text/javascript">

  function hide_delete_button(lecture_id) {
    $(`.lecture-${lecture_id} .deletelecture`).hide();
  }

  function show_delete_button(lecture_id) {
    if(!has_lecture_content(lecture_id)) {
      console.log("Exibindo botão de remoção de atividade...");
      $(`.lecture-${lecture_id}`).find('.deletelecture').show();
    }
  }

  function has_lecture_content(lecture_id) {
    let btn_add_content_class = '.addcontents';
    console.log($(`#lecture_add_content${lecture_id}`).find(btn_add_content_class).is(':visible'));
    return $(`#lecture_add_content${lecture_id}`).find(btn_add_content_class).is(':visible');
  }

  function dispose_video_lecture(lecture_id) {
    let video_id = $(`#videoresponse${lecture_id}`).find("video").attr('id');
    if(video_id) {
      console.log("Removendo vídeo: ", video_id);
      videojs(video_id).dispose();
    }
  }

  function initialize_video_lecture(lecture_id) {
    let video_id = $(`#videoresponse${lecture_id}`).find("video").attr('id');
    if(video_id) {
      console.log("Inicializando vídeo: ", video_id);
      videojs(video_id).reset();
    }
  }

$('.curriculam-block').bind({
    dragenter: function(e) {
        $(this).addClass('highlighted');
        return false;
    },
    dragover: function(e) {
        e.stopPropagation();
        e.preventDefault();
        return false;
    },
    dragleave: function(e) {
        $(this).removeClass('highlighted');
        return false;
    },
    drop: function(e) {
        var dt = e.originalEvent.dataTransfer;
        console.log(dt.files.length);
        return false;
    }
});

$(document).bind({
    dragenter: function(e) {
        e.stopPropagation();
        e.preventDefault();
        var dt = e.originalEvent.dataTransfer;
        dt.effectAllowed = dt.dropEffect = 'none';
    },
    dragover: function(e) {
        e.stopPropagation();
        e.preventDefault();
        var dt = e.originalEvent.dataTransfer;
        dt.effectAllowed = dt.dropEffect = 'none';
    }
});

$(document).ready(function(){
          
    $("#btn_lecture").click(function () {
        $('#new_lecture').val('');
        }); 
    $("#btn_quiz").click(function () {
        $('#new_quiz').val('');   
        tinyMCE.activeEditor.setContent("");
        }); 
    $("#btn_section").click(function () {
        $('#new_section').val('');
        }); 
    $("#btn_lecture").click(function () {
        $('#new_lecture').val('');
        }); 
  $(document).on('click','div.cctabs .cctab-link',function(){
    var tab_id = $(this).attr('data-tab');
    var tab_cc = $(this).attr('data-cc');
    
    if(tab_cc == '1'){
      $("#fromlibrary"+tab_id).removeClass('current');
      $("#fromlibrarytab"+tab_id).removeClass('current');
      $("#externalres"+tab_id).removeClass('current');
      $("#externalrestab"+tab_id).removeClass('current');
      $("#upfile"+tab_id).addClass('current');
      $("#upfiletab"+tab_id).addClass('current');
    } else if(tab_cc == '2'){
      $("#upfile"+tab_id).removeClass('current');
      $("#upfiletab"+tab_id).removeClass('current');
      $("#externalres"+tab_id).removeClass('current');
      $("#externalrestab"+tab_id).removeClass('current');
      $("#fromlibrary"+tab_id).addClass('current');
      $("#fromlibrarytab"+tab_id).addClass('current');
    } else if(tab_cc == '3'){
      $("#upfile"+tab_id).removeClass('current');
      $("#upfiletab"+tab_id).removeClass('current');
      $("#fromlibrary"+tab_id).removeClass('current');
      $("#fromlibrarytab"+tab_id).removeClass('current');
      $("#externalres"+tab_id).addClass('current');
      $("#externalrestab"+tab_id).addClass('current');
    }

    //remove error message
    $('#resresponse'+tab_id+' p').text(" ");

  });
  
  $(document).on('input','.chcountfield', function() {
    var len = $(this).val().length;
    var setval = parseInt('80')-parseInt(len);
    $(this).next('.ch-count').text(setval);
  });
  $(document).on('input','.count600', function() {
    var len = $(this).val().length;
    var setval = parseInt('600')-parseInt(len);
    $(this).next('.ch-count').text(setval);
  });
  
  tinymce.init({  
    mode : "specific_textareas",
    editor_selector : "curricullamEditor",
    theme : "advanced",
    entity_encoding: "raw",
    theme_advanced_buttons1 : "bold,italic,underline",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    width : "100%",
    plugins : "paste",
    paste_text_sticky : true,
    setup : function(ed) {
      ed.onInit.add(function(ed) {
        ed.pasteAsPlainText = true;
      });
    }
  });
  $('.curriculam_page').addClass('active');

  $( ".quizquestions" ).sortable({
    handle : '.quessort',
    update: function(e, ui) { 
      updatequizsorting($(this).data('lid'));
    }
  });
  
  $( ".su_course_curriculam_sortable ul" ).sortable({
  
  handle : '.sorthandle',
  connectWith : '.su_course_curriculam_sortable ul',

  //  update function 
  update: function(e, ui) { 

  // check lecture under section
  if($('.su_course_curriculam_sortable li:first-child').hasClass('childli')) {
    $(this).sortable('cancel');
    $(ui.sender).sortable('cancel');
  }
  // check quiz under section
  if($('.su_course_curriculam_sortable li:first-child').hasClass('quiz')) {
    $(this).sortable('cancel');
    $(ui.sender).sortable('cancel');
  }
   
  updatesorting();


  },
  start: function(e, ui){
    $(this).find('.curricullamEditor').each(function(){
      tinyMCE.execCommand( 'mceRemoveControl', false, $(this).attr('id') );
      $(this).hide();
    });
  },
  stop: function(e,ui) {
    $(this).find('.curricullamEditor').each(function(){
      $(this).show();
      tinyMCE.execCommand( 'mceAddControl', true, $(this).attr('id') );
      //$(this).sortable("refresh");
    });
  }

});

    /*
     * Adding new section
     */ 
    $('.su_course_add_section_label').click(function(){
      $(this).hide();
      $('.su_course_add_section_content').show();
    $('#section_title_counter').text('80');
    });

    $('.su_course_add_section_cancel').click(function(){
      $(this).parents('.su_course_add_section_content').hide();
      $('.su_course_add_section_label').show();
      $('.su_course_add_section_textbox').removeClass('error');
    });

  //Add new section for course
  $('.su_course_add_section_submit').click(function(){
    $('.su_course_add_section_submit').prop("disabled", true);
    if($.trim($('.su_course_add_section_textbox').val()).length >= 2) {
      var sno=$('.su_course_curriculam li.parentli').length+1;
      var cno=sno+1;
      var sval=$('.su_course_add_section_textbox').val();
      var courseid=$('[name="course_id"]').val();
      var coursesection=$('[name="coursesection"]').val();
      var _token=$('[name="_token"]').val();
      
      $.ajax ({
        type: "POST",
        url: coursesection,
        data: "&courseid="+courseid+"&section="+sval+"&position="+sno+"&id=0"+"&_token="+_token,
        success: function (msg)
        {
          
          $('.su_course_curriculam_sortable ul').append('<li class="su_gray_curr parentli section-'+msg+'"><div class="row-fluid sorthandle"><div class="col col-lg-12"><div class="su_course_section_label su_gray_curr_block"><div class="edit_option edit_option_section">Seção <span class="serialno">'+sno+'</span>: <label  class="slqtitle">'+sval+'</label> <input type="text" maxlength="80" class="chcountfield su_course_update_section_textbox" value="'+sval+'" /><span class="ch-count">'+(80-sval.length)+'</span></div><i class="fa fa-edit btn-edit-title"></i><input type="hidden" value="'+msg+'" class="sectionid" name="sectionids[]"/> <input type="hidden" value="'+sno+'" class="sectionpos" name="sectionposition[]"/><div class="deletesection" onclick="deletesection('+msg+')"><i class="fa fa-trash"></i></div><div class="updatesection" onclick="updatesection('+msg+')"><i class="fa fa-check"></i></div></div></div></div></li>');
          $('.su_course_add_section_textbox').val('')
          $('.su_course_add_section_label').show();
          $('.su_course_add_section_content').hide();
          $('.su_course_add_section_submit').prop("disabled", false);
        }
      });
    } else {
      $('.su_course_add_section_textbox').addClass('error');
      $('.su_course_add_section_submit').prop("disabled", false);
    }
  });

  // Cadastro de Atividade
  $('.su_course_add_lecture_submit').click(function(){
    $('.su_course_add_lecture_submit').prop("disabled", true);
    if($.trim($('.su_course_add_lecture_textbox').val()).length>1) {
      var sid=$('.su_course_curriculam_sortable li.parentli').last().find('.sectionid').val();
      var sno=1
      $( '.childli' ).each(function(){
        sno++;
      });
      var lqno=1;
      $( '.lq_sort' ).each(function(){
        lqno++;
      });

      var cno=$('.su_course_curriculam_sortable li.childli').length+2;
      var sval=$('.su_course_add_lecture_textbox').val();
      var courseid=$('[name="course_id"]').val();
      var courselecture=$('[name="courselecture"]').val();
      var _token=$('[name="_token"]').val();

      
      $.ajax ({
        type: "POST",
        url: courselecture,
        data: "&courseid="+courseid+"&lecture="+sval+"&position="+lqno+"&sectionid="+sid+"&_token="+_token,
        success: function (msg)
        {
          data = JSON.parse(msg);

          $('.su_course_add_lecture_submit').prop("disabled", false);
          
          let lecture_list = $( ".su_course_curriculam_sortable ul.clearfix.ui-sortable");
          lecture_list.append(data.lecture_content);
          lecture_list.sortable('refresh');
          //$('.su_course_add_lecture_content .col.col-lg-3 span').text(cno);
          $('.su_course_add_lecture_textbox').val('');
          $('.add_quiz_lecture_part').show();
          $('.su_course_add_lecture_content').hide();
          filesuploadajax();
          
          tinyMCE.execCommand('mceAddControl', false, 'textdesc-'+data.id);
          tinyMCE.execCommand('mceAddControl', false, 'lecturedesc-'+data.id);
        }
      });
    } else {
      $('.su_course_add_lecture_textbox').addClass('error');
      $('.su_course_add_lecture_submit').prop("disabled", false);
    }
  });

 /*
  $('.su_course_add_quiz_submit').click(function(){
    $('.su_course_add_quiz_submit').prop("disabled", true);
    if($.trim($('.su_course_add_quiz_textbox').val()).length>1) {
      var sid=$('.su_course_curriculam_sortable li.parentli').last().find('.sectionid').val();
      var sno=1;
      $( '.quiz' ).each(function(){
        sno++;
      });
      var lqno=1;
      $( '.lq_sort_quiz' ).each(function(){
        lqno++;
      });
      var stxt=$('.su_course_add_quiz_textbox').val();
      var sval=$('.su_course_add_quiz_textbox').val();
      var desc=$.trim(tinyClean(tinyMCE.get('quizdesc').getContent()));

      var courseid=$('[name="course_id"]').val();
      var coursequiz=$('[name="coursequiz"]').val();
      var _token=$('[name="_token"]').val();
      
      if(desc != ''){
        $.ajax ({
          type: "POST",
          url: coursequiz,
          data: "&courseid="+courseid+"&quiz="+stxt+"&description="+desc+"&position="+lqno+"&sectionid="+sid+"&_token="+_token,
          success: function (msg)
          {
            $('.su_course_curriculam_sortable ul').append('<li class="lq_sort_quiz su_lgray_curr quiz quiz-'+msg+' parent-s-'+sid+'"> <div class="row-fluid sorthandle"> <div class="col col-lg-12"> <div class="su_course_quiz_label su_lgray_curr_block">  <div class="edit_option edit_option_quiz">Quiz <span class="serialno">'+sno+'</span>: <label class="slqtitle">'+stxt+'</label><input type="text" maxlength="80" class="chcountfield su_course_update_quiz_textbox" value="'+stxt+'"><span class="ch-count">'+(80-stxt.length)+'</span> </div> <input type="hidden" value="'+msg+'" class="quizid" name="quizids[]"> <input type="hidden" value="'+lqno+'" class="quizpos" name="quizposition[]"> <input type="hidden" value="'+sid+'" class="quizsectionid" name="quizsectionid"> <div class="deletequiz" onclick="deletequiz('+msg+','+sid+')"></div> <div class="updatequiz" onclick="updatequiz('+msg+','+sid+')"></div> <div class="lecture_add_content" id="lecture_add_quiz'+msg+'"> <input type="button" name="lecture_add_quiz" value="Add Questions" class="addquestions" data-blockid="'+msg+'"> <div class="closeheader"> <span class="closetext"></span> <input type="button" name="lecture_close_question" value="X" class="btn-danger closequestion" data-blockid="'+msg+'"> </div> </div> </div> </div> </div> <div class="su_course_add_lecture_desc_content hideit nondata" id="questionsblock'+msg+'"> <div class="lecture_buttons lecture_edit_content"><input type="button" name="lecture_publish_content_quiz" class="btn btn-warning publishcontentquiz" value="{!! Lang::get("curriculum.Publish")!!}" data-blockid="'+msg+'"></div> <div class="divtitlehead"><p><strong>Questions</strong></p></div> <div class="formrow questionlist"> <div class="row-fluid quizquestions"> </div> </div> </div> <div class="lecturepopup hideit" id="quesblock-'+msg+'"> <div class="quizques"> <div class="quiz-type"> <div class="clearfix"> <div class="divli lquiz-multiple" data-lid="'+msg+'"  alt="multiple"><div class="quiztype"><span>Multiple Choice</span></div><label>Multiple Choice</label><div class="innershadowquiz"></div></div> <div class="divli lquiz-truefalse" data-lid="'+msg+'"  alt="truefalse"><div class="quiztype"><span>True / False</span></div><label>True / False</label><div class="innershadowquiz"></div></div> </div> </div> </div> </div> <div class="lecturepopup hideit" id="contentques-'+msg+'"> <div class="quizques"> <div class="divtitlehead"><p><strong>Question</strong></p></div> <div class="formrow margbot"> <div class="row-fluid"> <div><textarea name="quizquestion" id="quizquestion-'+msg+'" class="form-control curricullamEditor"></textarea></div> </div> </div> <div class="divtitlehead"><p><strong>Answers</strong></p></div> <div class="qmultiple hideit" id="multipleques-'+msg+'"> <div class="divtitlesub"><p>Write up to 5 believable options and choose the best answer.</p></div> <div class="qanswer"> <div class="col col-lg-12"> <input type="radio" name="answers-radio'+msg+'" value="1"> <input type="text" placeholder="Add an answer." class="chcountfield count600 answer" maxlength="600" name="answers[]" data-lid="'+msg+'"> <span class="answers-counter ch-count">600</span> </div> <div class="col col-lg-12"> <input type="text" placeholder="Explain why this is or isn\'t the best answer." class="chcountfield count600 answer-feedback" maxlength="600" name="answersfeedback[]"> <span class="answers-feedback-counter ch-count">600</span> </div> </div> <div class="qanswer"> <div class="col col-lg-12"> <input type="radio" name="answers-radio'+msg+'" value="2"> <input type="text" placeholder="Add an answer." class="chcountfield count600 answer" maxlength="600" name="answers[]" data-lid="'+msg+'"> <span class="answers-counter ch-count">600</span> </div> <div class="col col-lg-12"> <input type="text" placeholder="Explain why this is or isn\'t the best answer." class="chcountfield count600 answer-feedback" maxlength="600" name="answersfeedback[]"> <span class="answers-feedback-counter ch-count">600</span> </div> </div> <div class="qanswer"> <div class="col col-lg-12"> <div class="delques"><i class="fa fa-trash-o"></i></div> <input type="radio" name="answers-radio'+msg+'" value="3"> <input type="text" placeholder="Add an answer." class="chcountfield count600 qlastchild answer" maxlength="600" name="answers[]" data-lid="'+msg+'"> <span class="answers-counter ch-count">600</span> </div> <div class="col col-lg-12"> <input type="text" placeholder="Explain why this is or isn\'t the best answer." class="chcountfield count600 answer-feedback" maxlength="600" name="answersfeedback[]"> <span class="answers-feedback-counter ch-count">600</span> </div> </div> </div> <div class="qtruefalse hideit" id="truefalseques-'+msg+'"> <div class="divtitlesub"><p>Check the correct answer, and click Save.</p></div> <div class="formrow"> <div class="row-fluid"> <div class="col col-lg-2"> <input type="radio" id="radtrue'+msg+'" name="answers-radio'+msg+'" value="1"> True </div> <div class="col col-lg-2"> <input type="radio" id="radfalse'+msg+'" name="answers-radio'+msg+'" value="2"> False </div> </div> </div> </div> <div class="formrow"> <div class="row-fluid"> <input type="button" name="su_course_add_quiz_question_submit" value="Save" class="btn btn-warning su_course_add_quiz_question_submit"  data-lid="'+msg+'"> <input type="hidden" value="0" id="quiztype'+msg+'"> <input type="hidden" value="0" id="coption'+msg+'"> </div> </div> </div> </div> <div class="lecturepopup hideit editquestionpart" id="editquestionpart'+msg+'"></div> <div class="su_course_add_lecture_desc_content quizeditdesc" id="quizeditdesc'+msg+'"> <div class="divtitlehead"><p><strong>Description</strong></p></div> <textarea name="lectureeditdescription" id="lectureeditdesc-'+msg+'" class="form-control curricullamEditor"></textarea> <div class="quizeditdescription" id="quizeditdescription'+msg+'">'+desc+'</div> </div> </li>');
            $( ".su_course_curriculam_sortable ul" ).sortable('refresh');
            $('.su_course_add_quiz_textbox').val('');
            $('.add_quiz_lecture_part').show();
            $('.su_course_add_quiz_content').hide();
            $('.su_course_add_quiz_submit').prop("disabled", false);
            tinyMCE.get('quizdesc').setContent('');
            
            $('input[type="radio"]').iCheck({
              checkboxClass: 'icheckbox_square-green',
              radioClass: 'iradio_square-green',
            }); 
            
            tinyMCE.execCommand('mceAddControl', false, 'quizquestion-'+msg);
            tinyMCE.execCommand('mceAddControl', false, 'lectureeditdesc-'+msg);
          }
        });
      } else {
        alert("{!! Lang::get('curriculum.curriculum_description') !!}");
        $('.su_course_add_quiz_submit').prop("disabled", false);
      } 
    } else {
      $('.su_course_add_quiz_textbox').addClass('error');
      $('.su_course_add_quiz_submit').prop("disabled", false);
    }

  });
  */
  
  /*
  * Update course section text
  */
  $(document).on('click','.btn-edit-title',function(){
    var id=$(this).next().val();
    console.log(id);
    $('.section-'+id).addClass('editon');
    $(this).hide();
  });

  /*
  * Update course lecture text
  */
  $(document).on('click','.btn-edit-title',function(){
    var id=$(this).next().val();
    $('.lecture-'+id).addClass('editon');
    $(this).hide();
  });

  /*
  * Update course quiz text
  */
  $(document).on('click','.edit_option_quiz',function(){
    var id=$(this).next().val();
    if(!$('.quiz-'+id).hasClass('editon')) {
      var getdescr = $('#quizeditdescription'+id).html();
      tinyMCE.get('lectureeditdesc-'+id).setContent(getdescr);
    }
    $('.quiz-'+id).addClass('editon');
    $('#quizeditdesc'+id).show();
  });


  /*
  *   show hide for lecture and Quiz
  */

  //lecture
  
  $('.su_course_add_lecture_label').click(function(){
    $('#lecture_title_counter').text('80');
    if($('.su_course_curriculam_sortable li.parentli').length>0) {
      $('.add_quiz_lecture_part').hide();
      $('.su_course_add_lecture_content').show();
    } else {
      toastr.error('{!! Lang::get("curriculum.section_message")!!}');
    }
  });

  $('.su_course_add_lecture_cancel').click(function(){
    $(this).parents('.su_course_add_lecture_content').hide();
    $('.add_quiz_lecture_part').show();
    $('.su_course_add_lecture_textbox').removeClass('error');
  });

  //quiz

  $('.su_course_add_quiz_label').click(function(){
    $('#quiz_title_counter').text('80');
    if($('.su_course_curriculam_sortable li.parentli').length>0) {
      $('.add_quiz_lecture_part').hide();
      $('.su_course_add_quiz_content').show();
    } else {
      toastr.error('{!! Lang::get("curriculum.quiz_message")!!}');
    }
  });
  
  $('.su_course_add_quiz_cancel').click(function(){
    $(this).parents('.su_course_add_quiz_content').hide();
    $('.add_quiz_lecture_part').show();
    $('.su_course_add_quiz_textbox').removeClass('error');
  });  

  
  
  $(document).on('click','.resdelete',function () { 
    $(this).text('Deleting...');
    var _token=$('[name="_token"]').val();
    var lid = $(this).data('lid');
    var rid = $(this).data('rid');
    $.ajax ({
      type: "POST",
      url: $('[name="courselectureres"]').val(),
      data: "&courseid="+$('[name="course_id"]').val()+"&lid="+lid+"&rid="+rid+"&_token="+_token,
      success: function (msg)
      {
        $('#resources'+lid+'_'+rid).remove();
      }
    });
  });
  
  $(document).on('click','.addcontents',function () { 
    $(this).parent('div').children('.addcontents').hide();
    $(this).parent('div').children('.adddescription').hide();
    $(this).parent('div').children('.closeheader').children('.closecontents').show();
    $(this).parent('div').children('.closeheader').children('span.closetext').text('Conteúdo');
    $(this).parent('div').children('.closeheader').show();
    var cid = $(this).data('blockid');
    if ($('#wholeblock-'+cid).is(':visible')) { 
      $("#wholeblock-"+cid).hide(); 
    } 
    if ($("#wholeblock-"+cid).is(':visible')) { 
      $("#wholeblock-"+cid).hide();
    } else {
      $("#wholeblock-"+cid).show();
    }
    $('#contentpopshow'+cid).hide();
  });

  $(document).on('click','.closecontents',function () { 
    var cid = $(this).data('blockid');
    check_process = $('#probar_status_'+cid).val(); 
    if(check_process==1){
      toastr.error('{!! Lang::get("curriculum.process_in_progress")!!}');
      return false;
    }
    if($('#contentpopshow'+cid).hasClass('hideit')){
      $(this).parent('div').parent('div').children('.addcontents').show();
    }
    if($('#adddescblock-'+cid).hasClass('hideit')){
      $(this).parent('div').parent('div').children('.adddescription').show();
    }
    $(this).parent('div').parent('div').children('.closeheader').children('.closecontents').hide();
    $(this).parent('div').parent('div').children('.closeheader').children('span.closetext').text('');
    $(this).parent('div').parent('div').children('.closeheader').hide();
    
    if($('#adddescblock-'+cid).hasClass("hideit")) {
      $("#adddescblock-"+cid).hide();
    } else {
      $("#adddescblock-"+cid).show();
    }
    
    $("#wholeblock-"+cid).hide();
    if($('#contentpopshow'+cid).hasClass("hideit")) {
      $('#contentpopshow'+cid).hide();
      $('#videoresponse'+cid).hide();
      $('#wholevideos'+cid).show();
    } else {
      $('#contentpopshow'+cid).show();
      $('#videoresponse'+cid).show();
      $('#wholevideos'+cid).hide();
    }

    $('#cccontainer'+cid).hide();

    show_delete_button(cid);
  });

  $(document).on('click','.su_course_add_lecture_desc_cancel',function () { 
    tinyMCE.activeEditor.setContent("");
    var cid = $(this).attr('data-blockid');
    
    $('.lecture-'+cid + ' .deletelecture').show();

    if($('#contentpopshow'+cid).hasClass('hideit')){
      $('#lecture_add_content'+cid).children('.addcontents').show();
    } 
    if($('#adddescblock-'+cid).hasClass('hideit')){
      $('#lecture_add_content'+cid).children('.adddescription').show();
    } 
    $('#lecture_add_content'+cid).children('.closeheader').children('.closecontents').hide();
    $('#lecture_add_content'+cid).children('.closeheader').children('span.closetext').text('');
    $('#lecture_add_content'+cid).children('.closeheader').hide();
    
    if($('#adddescblock-'+cid).hasClass("hideit")) {
      $("#adddescblock-"+cid).hide();
      $("#descblock-"+cid).addClass('hideit');
      $("#editblock-"+cid).removeClass('hideit');
      $("#editblockfooter-"+cid).removeClass('hideit');
    } else {
      $("#adddescblock-"+cid).removeClass('editing');
      $('#descblock'+cid).removeClass('hideit');
      $('#editblock'+cid).addClass('hideit');
      $('#editblockfooter'+cid).addClass('hideit');
    }
    
    $("#wholeblock-"+cid).hide();
    if($('#contentpopshow'+cid).hasClass("hideit")) {
      $('#contentpopshow'+cid).hide();
      $('#videoresponse'+cid).hide();
      $('#wholevideos'+cid).show();
    } else {
      $('#contentpopshow'+cid).show();
      $('#videoresponse'+cid).show();
      $('#wholevideos'+cid).hide();
    }
    $('#cccontainer'+cid).hide();
  });

  $(document).on('click','.canceldesctext',function () { 
    tinyMCE.activeEditor.setContent("");
    var cid = $(this).attr('data-lid');
    if($('#contentpopshow'+cid).hasClass('hideit')){
      $('#lecture_add_content'+cid).children('.addcontents').show();
    }
    if($('#adddescblock-'+cid).hasClass('hideit')){
      $('#lecture_add_content'+cid).children('.adddescription').show();
    }
    $('#lecture_add_content'+cid).children('.closeheader').children('.closecontents').hide();
    $('#lecture_add_content'+cid).children('.closeheader').children('span.closetext').text('');
    $('#lecture_add_content'+cid).children('.closeheader').hide();
    
    show_delete_button(cid);

    if($('#adddescblock-'+cid).hasClass("hideit")) {
      $("#adddescblock-"+cid).hide();
      $("#descblock-"+cid).removeClass('hideit');
    } else {
      $("#adddescblock-"+cid).show();
      $("#descblock-"+cid).addClass('hideit');
    }
    
    $("#wholeblock-"+cid).hide();
    if($('#contentpopshow'+cid).hasClass("hideit")) {
      $('#contentpopshow'+cid).hide();
      $('#videoresponse'+cid).hide();
      $('#wholevideos'+cid).show();
    } else {
      $('#contentpopshow'+cid).show();
      $('#videoresponse'+cid).show();
      $('#wholevideos'+cid).hide();
    }
    $('#cccontainer'+cid).hide();
  });
  
  $(document).on('click','.adddescription',function () { 
    
    var cid = $(this).data('blockid');

    hide_delete_button(cid);

    let closeHeader = $(`#lecture_add_content${cid}`).children('.closeheader');

    closeHeader.children('.closecontents').show();
    closeHeader.children('span.closetext').text('Descrição');
    closeHeader.show();

    $('#contentpopshow'+cid).hide();
    if ($('#adddescblock-'+cid).is(':visible')) { 
      $("#adddescblock-"+cid).hide(); 
    } 
    if ($("#adddescblock-"+cid).is(':visible')) { 
      $("#adddescblock-"+cid).hide();
    } else {
      $("#adddescblock-"+cid).show(); 
    } 
  });

  $(document).on('click','.su_course_add_lecture_desc_submit',function(){
    var lid = $(this).data('lid');
    var text = $.trim(tinyClean(tinyMCE.get('lecturedesc-'+lid).getContent()));
    console.log(text);
    if(text != '') {
      var courselecturedesc =$('[name="courselecturedesc"]').val();
      var _token =$('[name="_token"]').val();
      $.ajax ({
        type: "POST",
        url: courselecturedesc,
        data: "courseid="+$('[name="course_id"]').val()+"&lecturedescription="+text+"&lid="+lid+"&_token="+_token,
        success: function (msg)
        { 
          if($('#contentpopshow'+lid).hasClass("hideit")) {
            $('#contentpopshow'+lid).hide();
            $('#videoresponse'+lid).hide();
            $('#wholevideos'+lid).show();
            $("#lecture_add_content"+lid).find('.addcontents').show();
          } else {
            $('#contentpopshow'+lid).show();
            $('#videoresponse'+lid).show();
            $('#wholevideos'+lid).hide();
          }
          $('#descriptions'+lid).html(text);
          // $('#getdbdescription'+lid).val(text);
          $('#descblock'+lid).removeClass('hideit');
          $("#adddescblock-"+lid).removeClass('editing');
          $("#adddescblock-"+lid).removeClass('hideit');
          $('#editblock'+lid).addClass('hideit');
          $('#editblockfooter'+lid).addClass('hideit');
          $('#lecture_add_content'+lid).find('.closeheader .closecontents').hide();
          $('#lecture_add_content'+lid).find('.closeheader span.closetext').text('');
          $('#lecture_add_content'+lid).find('.closeheader').hide();
          
          show_delete_button(lid);
          hide_description_button(lid);
        }
      });
    } else {
      toastr.error('{!! Lang::get("curriculum.curriculum_description") !!}');
    }
  });

  function hide_description_button(lecture_id) {
    $(`#lecture_edit_content${lecture_id}`).find('.adddescription').hide();
  }

  $(document).on('click','.publishcontent',function(){
    var lid = $(this).data('blockid');
    var courselecturepublish =$('[name="courselecturepublish"]').val();
    var _token =$('[name="_token"]').val();
    $(this).attr('name','lecture_unpublish_content');
    $(this).val('Cancelar Publicação');
    $(this).removeClass('publishcontent');
    $(this).addClass('unpublishcontent');
    $(this).removeClass('btn-warning');
    $(this).addClass('btn-danger');
    $.ajax ({
      type: "POST",
      url: courselecturepublish,
      data: "courseid="+$('[name="course_id"]').val()+"&publish=1&lid="+lid+"&_token="+_token,
      success: function (msg)
      {
        $('.lecture-'+lid).find('.su_course_lecture_label').removeClass('su_orange_curr_block');
        $('.lecture-'+lid).find('.su_course_lecture_label').addClass('su_green_curr_block');
      }
    });
  });

  $(document).on('click','.unpublishcontent',function(){
    var lid = $(this).data('blockid');
    var courselecturepublish =$('[name="courselecturepublish"]').val();
    var _token =$('[name="_token"]').val();
    $(this).attr('name','lecture_publish_content');
    $(this).val('Publicar');
    $(this).removeClass('unpublishcontent');
    $(this).addClass('publishcontent');
    $(this).removeClass('btn-danger');
    $(this).addClass('btn-warning');
    $.ajax ({
      type: "POST",
      url: courselecturepublish,
      data: "courseid="+$('[name="course_id"]').val()+"&publish=0&lid="+lid+"&_token="+_token,
      success: function (msg)
      {
        $('.lecture-'+lid).find('.su_course_lecture_label').removeClass('su_green_curr_block');
        $('.lecture-'+lid).find('.su_course_lecture_label').addClass('su_orange_curr_block');
      }
    });
  });

  $(document).on('click','.publishcontentquiz',function(){
    var lid = $(this).data('blockid');
    var courselecturepublish =$('[name="courselecturepublish"]').val();
    var _token =$('[name="_token"]').val();
    $(this).attr('name','lecture_unpublish_content_quiz');
    $(this).val('Unpublish');
    $(this).removeClass('publishcontentquiz');
    $(this).addClass('unpublishcontentquiz');
    $(this).removeClass('btn-warning');
    $(this).addClass('btn-danger');
    $.ajax ({
      type: "POST",
      url: courselecturepublish,
      data: "courseid="+$('[name="course_id"]').val()+"&publish=1&lid="+lid+"&_token="+_token,
      success: function (msg)
      {
        $('.quiz-'+lid).find('.su_course_quiz_label').removeClass('su_lgray_curr_block');
        $('.quiz-'+lid).find('.su_course_quiz_label').addClass('su_green_curr_block');
      }
    });
  });

  $(document).on('click','.unpublishcontentquiz',function(){
    var lid = $(this).data('blockid');
    var courselecturepublish =$('[name="courselecturepublish"]').val();
    var _token =$('[name="_token"]').val();
    $(this).attr('name','lecture_publish_content_quiz');
    $(this).val('Publish');
    $(this).removeClass('unpublishcontentquiz');
    $(this).addClass('publishcontentquiz');
    $(this).removeClass('btn-danger');
    $(this).addClass('btn-warning');
    $.ajax ({
      type: "POST",
      url: courselecturepublish,
      data: "courseid="+$('[name="course_id"]').val()+"&publish=0&lid="+lid+"&_token="+_token,
      success: function (msg)
      {
        $('.quiz-'+lid).find('.su_course_quiz_label').removeClass('su_green_curr_block');
        $('.quiz-'+lid).find('.su_course_quiz_label').addClass('su_lgray_curr_block');
      }
    });
  });

  $(document).on('click','.editdescription',function(){
    var lid = $(this).data('lid');
    var getdescr = $('#descriptions'+lid).html();
    $("#adddescblock-"+lid).addClass('editing');
    $('#descblock'+lid).addClass('hideit');
    $('#editblock'+lid).removeClass('hideit');
    $('#editblockfooter'+lid).removeClass('hideit');
    tinyMCE.get('lecturedesc-'+lid).setContent(getdescr);

  });

  $(document).on('click','.lmedia-video',function(){
    var mid = $(this).data('lid');
    var attr = $(this).attr('alt');
   
    if(attr=='video'){
      $('#externalrestab'+mid).removeClass('current');
      $('#externalres'+mid).removeClass('current');
      $('#fromlibrary'+mid).removeClass('current');
      $('#fromlibrarytab'+mid).removeClass('current');
      $('#upfile'+mid).addClass('current');
      $('#upfiletab'+mid).addClass('current');
      $('#contentpopshow'+mid).show();
      $('#allbar'+mid).show();
      $("#wholeblock-"+mid).hide();
      $('#resfiles-'+mid).hide();
      $('#videosfiles-'+mid).show();
      $('#audiofiles-'+mid).hide();
      $('#prefiles-'+mid).hide();
      $('#docfiles-'+mid).hide();
      $('#textdescfiles-'+mid).hide();
      $('#lecture_add_content'+mid).find('.closeheader span.closetext').text('Vídeo');
      $('#cctabs'+mid).show();
      
      $('#cccontainer'+mid).show();
      $('#upfile'+mid).addClass('current');
      $('#fromlibrary'+mid).removeClass('current');
      $('#cvideofiles'+mid).show();
      $('#caudiofiles'+mid).hide();
      $('#cprefiles'+mid).hide();
      $('#cdocfiles'+mid).hide();
      $('#cresfiles'+mid).hide();
    }

  });

  $(document).on('click','.lmedia-audio',function(){
    var mid = $(this).data('lid');
    var attr = $(this).attr('alt');

    if(attr=='audio'){
      $('#externalrestab'+mid).removeClass('current');
      $('#externalres'+mid).removeClass('current');
      $('#fromlibrary'+mid).removeClass('current');
      $('#fromlibrarytab'+mid).removeClass('current');
      $('#upfile'+mid).addClass('current');
      $('#upfiletab'+mid).addClass('current');
      $('#contentpopshow'+mid).show();
      $('#allbar'+mid).show();
      $("#wholeblock-"+mid).hide();
      $('#audiofiles-'+mid).show();
      $('#videosfiles-'+mid).hide();
      $('#resfiles-'+mid).hide();
      $('#prefiles-'+mid).hide();
      $('#docfiles-'+mid).hide();
      $('#textdescfiles-'+mid).hide();
      $('#lecture_add_content'+mid).find('.closeheader span.closetext').text('Aúdio');
      $('#cctabs'+mid).show();
      
      $('#cccontainer'+mid).show();
      $('#upfile'+mid).addClass('current');
      $('#fromlibrary'+mid).removeClass('current');
      $('#cvideofiles'+mid).hide();
      $('#caudiofiles'+mid).show();
      $('#cprefiles'+mid).hide();
      $('#cdocfiles'+mid).hide();
      $('#cresfiles'+mid).hide();
    }

  });

  $(document).on('click','.lmedia-presentation',function(){
    var mid = $(this).data('lid');
    var attr = $(this).attr('alt');
   
    if(attr=='presentation'){
      $('#externalrestab'+mid).removeClass('current');
      $('#externalres'+mid).removeClass('current');
      $('#fromlibrary'+mid).removeClass('current');
      $('#fromlibrarytab'+mid).removeClass('current');
      $('#upfile'+mid).addClass('current');
      $('#upfiletab'+mid).addClass('current');
      $('#contentpopshow'+mid).show();
      $('#allbar'+mid).show();
      $("#wholeblock-"+mid).hide();
      $('#resfiles-'+mid).hide();
      $('#prefiles-'+mid).show();
      $('#docfiles-'+mid).hide();
      $('#audiofiles-'+mid).hide();
      $('#videosfiles-'+mid).hide();
      $('#textdescfiles-'+mid).hide();
      $('#lecture_add_content'+mid).find('.closeheader span.closetext').text('Apresentação');
      $('#cctabs'+mid).show();
      
      $('#cccontainer'+mid).show();
      $('#cvideofiles'+mid).hide();
      $('#caudiofiles'+mid).hide();
      $('#cprefiles'+mid).show();
      $('#cdocfiles'+mid).hide();
      $('#cresfiles'+mid).hide();
    }

  });

  $(document).on('click','.lmedia-file',function(){
    var mid = $(this).data('lid');
    var attr = $(this).attr('alt');
    
    if(attr=='file'){
      $('#externalrestab'+mid).removeClass('current');
      $('#externalres'+mid).removeClass('current');
      $('#fromlibrary'+mid).removeClass('current');
      $('#fromlibrarytab'+mid).removeClass('current');
      $('#upfile'+mid).addClass('current');
      $('#upfiletab'+mid).addClass('current');
      $('#contentpopshow'+mid).show();
      $('#allbar'+mid).show();
      $("#wholeblock-"+mid).hide();
      $('#resfiles-'+mid).hide();
      $('#prefiles-'+mid).hide();
      $('#docfiles-'+mid).show();
      $('#audiofiles-'+mid).hide();
      $('#videosfiles-'+mid).hide();
      $('#textdescfiles-'+mid).hide();
      $('#lecture_add_content'+mid).find('.closeheader span.closetext').text('Documento');
      $('#cctabs'+mid).show();
      
      $('#cccontainer'+mid).show();
      $('#cvideofiles'+mid).hide();
      $('#caudiofiles'+mid).hide();
      $('#cprefiles'+mid).hide();
      $('#cdocfiles'+mid).show();
      $('#cresfiles'+mid).hide();
    }

  });

  $(document).on('click','.lmedia-text',function(){
    var mid = $(this).data('lid');
    var attr = $(this).attr('alt');
    
    if(attr=='text'){
      $('#externalrestab'+mid).removeClass('current');
      $('#externalres'+mid).removeClass('current');
      $('#fromlibrary'+mid).removeClass('current');
      $('#fromlibrarytab'+mid).removeClass('current');
      $('#upfile'+mid).addClass('current');
      $('#upfiletab'+mid).addClass('current');
      $('#contentpopshow'+mid).show();
      $('#textdescfiles-'+mid).show();
      $('#allbar'+mid).hide();
      $("#wholeblock-"+mid).hide();
      $('#resfiles-'+mid).hide();
      $('#prefiles-'+mid).hide();
      $('#docfiles-'+mid).hide();
      $('#audiofiles-'+mid).hide();
      $('#videosfiles-'+mid).hide();
      $('#lecture_add_content'+mid).find('.closeheader span.closetext').text('Texto');
      $('#cctabs'+mid).hide();
      
      $('#cccontainer'+mid).show();
      $('#cvideofiles'+mid).hide();
      $('#caudiofiles'+mid).hide();
      $('#cprefiles'+mid).hide();
      $('#cdocfiles'+mid).hide();
      $('#cresfiles'+mid).hide();
    }

  });

  $(document).on('click','.addresource',function(){
    var mid = $(this).data('blockid');
    var attr = $(this).data('alt');
    
    if(attr=='resource'){
      $('#externalrestab'+mid).show();
      $('#contentpopshow'+mid).show();
      $('#allbar'+mid).show();
      $("#wholeblock-"+mid).hide();
      $("#wholevideos"+mid).show();
      $('#resfiles-'+mid).show();
      $('#videoresponse'+mid).hide();
      $('#prefiles-'+mid).hide();
      $('#docfiles-'+mid).hide();
      $('#audiofiles-'+mid).hide();
      $('#videosfiles-'+mid).hide();
      $('#textdescfiles-'+mid).hide();
      $("#lecture_add_content"+mid).find('.adddescription').hide();
      $("#lecture_add_content"+mid).find('.closeheader .closecontents').show();
      $("#lecture_add_content"+mid).find('.closeheader span.closetext').text("{!! Lang::get('curriculum.Add_Resource') !!}");
      $("#lecture_add_content"+mid).find('.closeheader').show();
      
      $('#cccontainer'+mid).show();
      $('#upfile'+mid).addClass('current');
      $('#fromlibrary'+mid).removeClass('current');
      $('#cvideofiles'+mid).hide();
      $('#caudiofiles'+mid).hide();
      $('#cprefiles'+mid).hide();
      $('#cdocfiles'+mid).hide();
      $('#cresfiles'+mid).show();
    }

  });
  

  $(document).on('click','.editlectcontent',function(){
    var mid = $(this).data('blockid');

    hide_delete_button(mid);

    var attr = $(this).data('alt');
    $('#cccontainer'+mid).show();
    $('#externalrestab'+mid).removeClass('current');
    $('#externalres'+mid).removeClass('current');
    $('#fromlibrary'+mid).removeClass('current');
    $('#fromlibrarytab'+mid).removeClass('current');
    $('#upfiletab'+mid).addClass('current');
    $('#upfile'+mid).addClass('current');
    
    if(attr=='video'){
      
      $('#externalrestab'+mid).hide();
      $("#wholeblock-"+mid).hide();
      $("#videoresponse"+mid).hide();
      $("#lecture_add_content"+mid).find('.adddescription').hide();
      $("#lecture_add_content"+mid).find('.closecontents').show();
      $("#lecture_add_content"+mid).find('.closeheader .closecontents').show();
      $("#lecture_add_content"+mid).find('.closeheader span.closetext').text('Editar Vídeo');
      $("#lecture_add_content"+mid).find('.closeheader').show();
      
      $('#contentpopshow'+mid).show();
      $('#allbar'+mid).show();
      $("#wholevideos"+mid).removeClass('hideit');
      $("#wholevideos"+mid).show();
      $('#videosfiles-'+mid).show();
      $('#audiofiles-'+mid).hide();
      $('#prefiles-'+mid).hide();
      $('#docfiles-'+mid).hide();
      $('#resfiles-'+mid).hide();
      $('#textdescfiles-'+mid).hide();
      $('#cctabs'+mid).show();
      
      $('#cvideofiles'+mid).show();
      $('#caudiofiles'+mid).hide();
      $('#cprefiles'+mid).hide();
      $('#cdocfiles'+mid).hide();
      $('#cresfiles'+mid).hide();
      
    } else if(attr=='audio'){
      
      $('#externalrestab'+mid).hide();
      $("#wholeblock-"+mid).hide();
      $("#videoresponse"+mid).hide();
      $("#lecture_add_content"+mid).find('.adddescription').hide();
      $("#lecture_add_content"+mid).find('.closeheader .closecontents').show();
      $("#lecture_add_content"+mid).find('.closeheader span.closetext').text('Editar Áudio');
      $("#lecture_add_content"+mid).find('.closeheader').show();
      
      $('#contentpopshow'+mid).show();
      $('#allbar'+mid).show();
      $("#wholevideos"+mid).removeClass('hideit');
      $("#wholevideos"+mid).show();
      $('#audiofiles-'+mid).show();
      $('#videosfiles-'+mid).hide();
      $('#prefiles-'+mid).hide();
      $('#docfiles-'+mid).hide();
      $('#resfiles-'+mid).hide();
      $('#textdescfiles-'+mid).hide();
      $('#cctabs'+mid).show();
      
      $('#cvideofiles'+mid).hide();
      $('#caudiofiles'+mid).show();
      $('#cprefiles'+mid).hide();
      $('#cdocfiles'+mid).hide();
      $('#cresfiles'+mid).hide();
      
    } else if(attr=='presentation'){
      
      $('#externalrestab'+mid).hide();
      $("#wholeblock-"+mid).hide();
      $("#videoresponse"+mid).hide();
      $("#lecture_add_content"+mid).find('.adddescription').hide();
      $("#lecture_add_content"+mid).find('.closeheader .closecontents').show();
      $("#lecture_add_content"+mid).find('.closeheader span.closetext').text('Edit Document');
      $("#lecture_add_content"+mid).find('.closeheader').show();
      
      $('#contentpopshow'+mid).show();
      $('#allbar'+mid).show();
      $("#wholevideos"+mid).removeClass('hideit');
      $("#wholevideos"+mid).show();
      $('#prefiles-'+mid).show();
      $('#docfiles-'+mid).hide();
      $('#audiofiles-'+mid).hide();
      $('#videosfiles-'+mid).hide();
      $('#resfiles-'+mid).hide();
      $('#textdescfiles-'+mid).hide();
      $('#cctabs'+mid).show();
      
      $('#cvideofiles'+mid).hide();
      $('#caudiofiles'+mid).hide();
      $('#cprefiles'+mid).show();
      $('#cdocfiles'+mid).hide();
      $('#cresfiles'+mid).hide();
      
    } else if(attr=='file'){
      
      $('#externalrestab'+mid).hide();
      $("#wholeblock-"+mid).hide();
      $("#videoresponse"+mid).hide();
      $("#lecture_add_content"+mid).find('.adddescription').hide();
      $("#lecture_add_content"+mid).find('.closeheader .closecontents').show();
      $("#lecture_add_content"+mid).find('.closeheader span.closetext').text('Editar Documento');
      $("#lecture_add_content"+mid).find('.closeheader').show();
      
      $('#contentpopshow'+mid).show();
      $('#allbar'+mid).show();
      $("#wholevideos"+mid).removeClass('hideit');
      $("#wholevideos"+mid).show();
      $('#prefiles-'+mid).hide();
      $('#docfiles-'+mid).show();
      $('#audiofiles-'+mid).hide();
      $('#videosfiles-'+mid).hide();
      $('#resfiles-'+mid).hide();
      $('#textdescfiles-'+mid).hide();
      $('#cctabs'+mid).show();
      
      $('#cvideofiles'+mid).hide();
      $('#caudiofiles'+mid).hide();
      $('#cprefiles'+mid).hide();
      $('#cdocfiles'+mid).show();
      $('#cresfiles'+mid).hide();
      
    } else if(attr=='text'){
    
      var getltext = $('#lecture_contenttext'+mid).html();
      tinyMCE.get('textdesc-'+mid).setContent(getltext);
      
      $('#externalrestab'+mid).hide();
      $("#wholeblock-"+mid).hide();
      $("#videoresponse"+mid).hide();
      $("#lecture_add_content"+mid).find('.adddescription').hide();
      $("#lecture_add_content"+mid).find('.closeheader .closecontents').show();
      $("#lecture_add_content"+mid).find('.closeheader span.closetext').text('Editar Texto');
      $("#lecture_add_content"+mid).find('.closeheader').show();
      
      $('#contentpopshow'+mid).show();
      $("#wholevideos"+mid).removeClass('hideit');
      $("#wholevideos"+mid).show();
      $('#textdescfiles-'+mid).show();
      $('#allbar'+mid).hide();
      $('#prefiles-'+mid).hide();
      $('#docfiles-'+mid).hide();
      $('#audiofiles-'+mid).hide();
      $('#resfiles-'+mid).hide();
      $('#videosfiles-'+mid).hide();
      $('#cctabs'+mid).hide();
      
      $('#cvideofiles'+mid).hide();
      $('#caudiofiles'+mid).hide();
      $('#cprefiles'+mid).hide();
      $('#cdocfiles'+mid).hide();
      $('#cresfiles'+mid).hide();
    }
  });
  
  $(document).on('click','.updatelibcontent',function(){
    
    var lid = $(this).attr('data-lid');
    var lib = $(this).attr('data-lib');
    var alt = $(this).attr('data-alt');
    var type = $(this).attr('data-type');
    var courseselectlibrary =$('[name="courseselectlibrary"]').val();
    var _token =$('[name="_token"]').val();

    dispose_video_lecture(lid);

    $.ajax ({
      type: "POST",
      url: courseselectlibrary,
      data: "courseid="+$('[name="course_id"]').val()+"&lid="+lid+"&lib="+lib+"&type="+alt+"&_token="+_token,
      success: function (data)
      { var return_data = $.parseJSON( data );
        if(return_data.status='true'){
          $("#contentpopshow"+lid).removeClass('hideit');
          $("#cccontainer"+lid).hide();
          $("#videoresponse"+lid).text("");
          $("#wholevideos"+lid).hide();
          $('#videoresponse'+lid).show();
          if($('#adddescblock-'+lid).hasClass('hideit')){
            $("#lecture_add_content"+lid).find('.adddescription').show();
          }
          $('#lecture_add_content'+lid).find('.closeheader .closecontents').hide();
          $('#lecture_add_content'+lid).find('.closeheader span.closetext').text('');
          $('#lecture_add_content'+lid).find('.closeheader').hide();
          $('.lecture-'+lid).find('.su_course_lecture_label').removeClass('su_lgray_curr_block');
          $('.lecture-'+lid).find('.su_course_lecture_label').removeClass('su_green_curr_block');
          $('.lecture-'+lid).find('.su_course_lecture_label').addClass('su_orange_curr_block');
          $("#videoresponse"+lid).append(return_data.view);
          show_delete_button(lid);
          initialize_video_lecture(lid);
        }else{

        }
      }
    });
  });
  
  $(document).on('click','.updaterescontent',function(){
    var lid = $(this).attr('data-lid');
    var lib = $(this).attr('data-lib');
    var file_data = $(this).text();
    var courseselectlibraryres =$('[name="courseselectlibraryres"]').val();
    var _token =$('[name="_token"]').val();
    $.ajax ({
      type: "POST",
      url: courseselectlibraryres,
      data: "courseid="+$('[name="course_id"]').val()+"&lid="+lid+"&lib="+lib+"&_token="+_token,
      success: function (data)
      { var return_data = $.parseJSON( data );
        if(return_data.status='true'){
          $("#cccontainer"+lid).hide();
          $("#resresponse"+lid).text("");
          $("#wholevideos"+lid).hide();
          $('#videoresponse'+lid).show();
          $("#lecture_add_content"+lid).find('.adddescription').hide();
          $("#lecture_add_content"+lid).find('.closecontents').show();
          $('#resourceblock'+lid).show();
          $('#resourceblock'+lid).find('.resourcefiles').append('<div id="resources'+lid+'_'+lib+'"><i class="fa fa-download"></i> '+file_data+' <div class="goright resdelete" data-lid="'+lid+'" data-rid="'+lib+'"><i class="goright fa fa-trash-o"></i></div></div>');
        }else{

        }
      }
    });
  });
  
  $(document).on('click','.su_course_add_res_link_submit',function(){
    var lid = $(this).attr('data-lid');
    var title = $('#exres_title'+lid).val();
    title = $.trim(title);
    var link = $('#exres_link'+lid).val();
    link = $.trim(link);

    //check link url validation
    if(!checkURL(link)){
      toastr.error('{!! Lang::get("curriculum.res_invalid_url") !!}');
      $('#exres_link'+lid).focus();
      return false;
    }

    if(title != '' && link != ''){
      $(this).attr('disabled','disabled');
      var courseexternalres =$('[name="courseexternalres"]').val();
      var _token =$('[name="_token"]').val();
      $.ajax ({
        type: "POST",
        url: courseexternalres,
        data: "courseid="+$('[name="course_id"]').val()+"&lid="+lid+"&title="+title+"&link="+link+"&_token="+_token,
        success: function (data)
        { var return_data = $.parseJSON( data );
          $('.su_course_add_res_link_submit').removeAttr('disabled');
          if(return_data.status='true'){
            $("#cccontainer"+lid).hide();
            $("#resresponse"+lid).text("");
            $("#wholevideos"+lid).hide();
            $('#videoresponse'+lid).show();
            $("#lecture_add_content"+lid).find('.adddescription').hide();
            $("#lecture_add_content"+lid).find('.closecontents').show();
            $('#resourceblock'+lid).show();
            $('#resourceblock'+lid).find('.resourcefiles').append('<div id="resources'+lid+'_'+return_data.file_id+'"><i class="fa fa-external-link"></i> '+return_data.file_title +' <div class="goright resdelete" data-lid="'+lid+'" data-rid="'+return_data.file_id+'"><i class="goright fa fa-trash-o"></i></div></div>');
            $('#exres_title'+lid).val("");
            $('#exres_link'+lid).val("");
          }else{
            
          }
        }
      });
    } else {
      toastr.error('{!! Lang::get("curriculum.curriculum_empty")!!}');
    }
  });
  
  $(document).on('click','.vid_preview',function(){
    var lid = $(this).data('id');
    $("#video_preview"+lid).slideToggle();
  });
  
  $(document).on('click','.aud_preview',function(){
    var lid = $(this).data('id');
    $("#audio_preview"+lid).slideToggle();
  });
  
  // Cadastro de Textos
  $(document).on('click','.savedesctext',function(){
    var lid = $(this).data('lid');
    var text = $.trim(tinyClean(tinyMCE.get('textdesc-'+lid).getContent()));
    if(text != ''){
      var courselecturetext =$('[name="courselecturetext"]').val();
      var _token =$('[name="_token"]').val();
      $.ajax ({
        type: "POST",
        url: courselecturetext,
        data: "courseid="+$('[name="course_id"]').val()+"&lecturedescription="+text+"&lid="+lid+"&_token="+_token,
        success: function (data)
        { var return_data = $.parseJSON( data );
          if(return_data.status='true'){
            $("#contentpopshow"+lid).removeClass('hideit');
            $("#cccontainer"+lid).hide();
            $('#probar'+lid).css('width','0%');
            $("#videoresponse"+lid).text("");
            $("#wholevideos"+lid).hide();
            $('#videoresponse'+lid).show();

            $('#lecture_add_content'+lid).find('.closeheader .closecontents').hide();
            $('#lecture_add_content'+lid).find('.closeheader span.closetext').text('');
            $('#lecture_add_content'+lid).find('.closeheader').hide();
            $('.lecture-'+lid).find('.su_course_lecture_label').removeClass('su_lgray_curr_block');
            $('.lecture-'+lid).find('.su_course_lecture_label').removeClass('su_green_curr_block');
            $('.lecture-'+lid).find('.su_course_lecture_label').addClass('su_orange_curr_block');
            $("#videoresponse"+lid).append(return_data.lecture_content);

            show_delete_button(lid);
          }else{

          }
        }
      });
    } else {
      toastr.error('{!! Lang::get("curriculum.curriculum_text_empty") !!}');
    }
  });
  });
  

function show_progress_bar(lecture_id) {
  $(`.lecture-${lecture_id} .luploadvideo-progressbar`).fadeIn();
}

function hide_progress_bar(lecture_id) {
  $(`.lecture-${lecture_id} .luploadvideo-progressbar`).hide();
}

filesuploadajax();

function filesuploadajax(){

  $('.videofiles').fileupload({
    autoUpload: true,
    acceptFileTypes: /(\.|\/)(mp4|avi|mov|flv)$/i,
    maxFileSize: 4096000000, // 4 GB
    start: function (e, data) {
      dispose_video_lecture($(e.target).attr('data-lid'));
      show_progress_bar($(e.target).attr('data-lid'));
    },
    progress: function (e, data) {
      $("#videoresponse"+data.lid).text("");
      $('#probar_status_'+data.lid).val(1);
      var percentage = parseInt(data.loaded / data.total * 100);
      $('#probar'+data.lid).css('width',percentage+'%');
      if(percentage == '100') {
        $('#probar'+data.lid).text('{!! Lang::get("curriculum.video_process")!!}');
      }
    },
    processfail: function (e, data) {
      file_name = data.files[data.index].name;
      $('#probar_status_'+data.lid).val(0);
      toastr.error("{!! Lang::get('curriculum.lecture_video_file')!!}"); 
    },
    done: function(e, data){
      var return_data = $.parseJSON( data.result );
      if(return_data.status='true'){
        $("#contentpopshow"+data.lid).removeClass('hideit');
        $("#cccontainer"+data.lid).hide();
        $('#probar'+data.lid).css('width','0%');
        $("#videoresponse"+data.lid).text("");
        $("#wholevideos"+data.lid).hide();
        $('#videoresponse'+data.lid).show();
        if($('#adddescblock-'+data.lid).hasClass('hideit')){
          $("#lecture_add_content"+data.lid).find('.adddescription').show();
        } 
        $('#lecture_add_content'+data.lid).find('.closeheader .closecontents').hide();
        $('#lecture_add_content'+data.lid).find('.closeheader span.closetext').text('');
        $('#lecture_add_content'+data.lid).find('.closeheader').hide();
        $('.lecture-'+data.lid).find('.su_course_lecture_label').removeClass('su_lgray_curr_block');
        $('.lecture-'+data.lid).find('.su_course_lecture_label').removeClass('su_green_curr_block');
        $('.lecture-'+data.lid).find('.su_course_lecture_label').addClass('su_orange_curr_block');
        $("#videoresponse"+data.lid).html(return_data.view);
        
        initialize_video_lecture(data.lid);
        
        $('#probar_status_'+data.lid).val(0);
        show_delete_button(data.lid);
        hide_progress_bar(data.lid);
        //<video class="video-js vjs-default-skin" controls preload="auto" data-setup="{}"><source src="'+return_data.file_link+'" type="video/webm" id="videosource"></video>
      }

      
    }
  });

  // Cadastro de Áudios
  $('.audiofiles').fileupload({
    autoUpload: true,
    acceptFileTypes: /(\.|\/)(mp3|wav)$/i,
    maxFileSize: 1024000000, // 1 GB
    start: function (e, data) {
      show_progress_bar($(e.target).attr('data-lid'));
    },
    progress: function (e, data) {
      $("#videoresponse"+data.lid).text("");
      $('#probar_status_'+data.lid).val(1);
      var percentage = parseInt(data.loaded / data.total * 100);
      $('#probar'+data.lid).css('width',percentage+'%');
      if(percentage == '100') {
        $('#probar'+data.lid).text('{!! Lang::get("curriculum.audio_process")!!}');
      }
    },
    processfail: function (e, data) {
      file_name = data.files[data.index].name;
      $('#probar_status_'+data.lid).val(0);
      toastr.error("{!! Lang::get('curriculum.lecture_audio_file')!!}");     
    },
    done: function(e, data){
      var return_data = $.parseJSON( data.result );
      if(return_data.status='true'){
        $("#contentpopshow"+data.lid).removeClass('hideit');
        $("#cccontainer"+data.lid).hide();
        $('#probar'+data.lid).css('width','0%');
        $("#videoresponse"+data.lid).text("");
        $("#wholevideos"+data.lid).hide();
        $('#videoresponse'+data.lid).show();
        if($('#adddescblock-'+data.lid).hasClass('hideit')){
          $("#lecture_add_content"+data.lid).find('.adddescription').show();
        } 
        $('#lecture_add_content'+data.lid).find('.closeheader .closecontents').hide();
        $('#lecture_add_content'+data.lid).find('.closeheader span.closetext').text('');
        $('#lecture_add_content'+data.lid).find('.closeheader').hide();
        $('.lecture-'+data.lid).find('.su_course_lecture_label').removeClass('su_lgray_curr_block');
        $('.lecture-'+data.lid).find('.su_course_lecture_label').removeClass('su_green_curr_block');
        $('.lecture-'+data.lid).find('.su_course_lecture_label').addClass('su_orange_curr_block');
        
        $("#videoresponse"+data.lid).append(return_data.view);
        
        $('#probar_status_'+data.lid).val(0);
        show_delete_button(data.lid);
        hide_progress_bar(data.lid);
      }
      
    }
  });

  $('.prefiles').fileupload({
    autoUpload: true,
    acceptFileTypes: /(\.|\/)(pdf)$/i,
    maxFileSize: 1024000000, // 1 GB
    progress: function (e, data) {
     
      $("#videoresponse"+data.lid).text("");
      $('#probar_status_'+data.lid).val(1);
      var percentage = parseInt(data.loaded / data.total * 100);
      $('#probar'+data.lid).css('width',percentage+'%');
      if(percentage == '100') {
        $('#probar'+data.lid).text('{!! Lang::get("curriculum.lecture_file_process")!!}');
      }
    },
    processfail: function (e, data) {
      file_name = data.files[data.index].name;
      $('#probar_status_'+data.lid).val(0);
      toastr.error("{!! Lang::get('curriculum.lecture_pdf_file')!!}");   
    },
    done: function(e, data){
      var return_data = $.parseJSON( data.result );
      if(return_data.status='true'){
        $("#contentpopshow"+data.lid).removeClass('hideit');
        $("#cccontainer"+data.lid).hide();
        $('#probar'+data.lid).css('width','0%');
        $("#videoresponse"+data.lid).text("");
        $("#wholevideos"+data.lid).hide();
        $('#videoresponse'+data.lid).show();
        if($('#adddescblock-'+data.lid).hasClass('hideit')){
          $("#lecture_add_content"+data.lid).find('.adddescription').show();
        } 
        $('#lecture_add_content'+data.lid).find('.closeheader .closecontents').hide();
        $('#lecture_add_content'+data.lid).find('.closeheader span.closetext').text('');
        $('#lecture_add_content'+data.lid).find('.closeheader').hide();
        $('.lecture-'+data.lid).find('.su_course_lecture_label').removeClass('su_lgray_curr_block');
        $('.lecture-'+data.lid).find('.su_course_lecture_label').removeClass('su_green_curr_block');
        $('.lecture-'+data.lid).find('.su_course_lecture_label').addClass('su_orange_curr_block');
        $("#videoresponse"+data.lid).append('<div class="lecture_main_content_first_block1"><div class="lc_details imagetype-presentation"><div class="lecture_title"><p>'+return_data.file_title+'</p><p>'+return_data.duration+'</p></div><div class="lecture_buttons"><div class="lecture_edit_content" id="lecture_edit_content'+data.lid+'"> <input type="button" name="lecture_edit_content" class="btn editlectcontent btn-secondary" value="{!! Lang::get("curriculum.Edit_Content") !!}" data-blockid="'+data.lid+'" data-alt="presentation"> <input type="button" name="lecture_resource_content" class="btn btn-info addresource" value="{!! Lang::get("curriculum.Add_Resource") !!}" data-blockid="'+data.lid+'" data-alt="resource"> <input type="button" name="lecture_publish_content" class="btn btn-warning publishcontent" value="{!! Lang::get("curriculum.Publish")!!}" data-blockid="'+data.lid+'"></div></div></div></div>');
        $('#probar_status_'+data.lid).val(0);
      }else{

      }

    }
  });

  // Cadastro de Documentos
  $('.docfiles').fileupload({
    autoUpload: true,
    acceptFileTypes: /(\.|\/)(pdf)$/i,
    maxFileSize: 1024000000, // 1 GB
    start: function (e, data) {
      show_progress_bar($(e.target).attr('data-lid'));
    },
    progress: function (e, data) {
     
      $('#probar_status_'+data.lid).val(1);
      $("#videoresponse"+data.lid).text("");
      var percentage = parseInt(data.loaded / data.total * 100);
      $('#probar'+data.lid).css('width',percentage+'%');
      if(percentage == '100') {
        $('#probar'+data.lid).text('{!! Lang::get("curriculum.lecture_file_process")!!}');
      }
    },
    processfail: function (e, data) {
      $('#probar_status_'+data.lid).val(0);
      file_name = data.files[data.index].name;
      toastr.error("{!! Lang::get('curriculum.lecture_pdf_file')!!}");     
    },
    done: function(e, data){
      var return_data = $.parseJSON( data.result );
      if(return_data.status='true'){
        $("#contentpopshow"+data.lid).removeClass('hideit');
        $("#cccontainer"+data.lid).hide();
        $('#probar'+data.lid).css('width','0%');
        $("#videoresponse"+data.lid).text("");
        $("#wholevideos"+data.lid).hide();
        $('#videoresponse'+data.lid).show();
        if($('#adddescblock-'+data.lid).hasClass('hideit')){
          $("#lecture_add_content"+data.lid).find('.adddescription').show();
        } 
        $('#lecture_add_content'+data.lid).find('.closeheader .closecontents').hide();
        $('#lecture_add_content'+data.lid).find('.closeheader span.closetext').text('');
        $('#lecture_add_content'+data.lid).find('.closeheader').hide();
        $('.lecture-'+data.lid).find('.su_course_lecture_label').removeClass('su_lgray_curr_block');
        $('.lecture-'+data.lid).find('.su_course_lecture_label').removeClass('su_green_curr_block');
        $('.lecture-'+data.lid).find('.su_course_lecture_label').addClass('su_orange_curr_block');
        $("#videoresponse"+data.lid).append(return_data.view);
        $('#probar_status_'+data.lid).val(0);
        show_delete_button(data.lid);
        hide_progress_bar(data.lid);
      }
    }
  }); 

  $('.resfiles').fileupload({
    autoUpload: true,
    acceptFileTypes: /(\.|\/)(pdf|doc|docx)$/i,
    maxFileSize: 1024000000, // 1 GB
    progress: function (e, data) {
      
      $('#probar_status_'+data.lid).val(1);
      $("#resresponse"+data.lid).text("");
      var percentage = parseInt(data.loaded / data.total * 100);
      $('#probar'+data.lid).css('width',percentage+'%');
      if(percentage == '100') {
        $('#probar'+data.lid).text('{!! Lang::get("curriculum.lecture_file_process")!!}');
      }
    },
    processfail: function (e, data) {
      $('#probar_status_'+data.lid).val(0);
      file_name = data.files[data.index].name;
      toastr.error("{!! Lang::get('curriculum.lecture_file_not_allowed')!!}");   
  },
    done: function(e, data){
      var return_data = $.parseJSON( data.result );
      if(return_data.status='true'){
        $("#cccontainer"+data.lid).hide();
        $("#resresponse"+data.lid).text("");
        $('#probar'+data.lid).css('width','0%');
        $("#wholevideos"+data.lid).hide();
        $('#videoresponse'+data.lid).show();            
        $("#lecture_add_content"+data.lid).find('.adddescription').hide();
        $("#lecture_add_content"+data.lid).find('.closecontents').show();
        $('#resourceblock'+data.lid).show();
        $('#resourceblock'+data.lid).find('.resourcefiles').append('<div id="resources'+data.lid+'_'+return_data.file_id+'"><i class="fa fa-download"></i> '+return_data.file_title+' ('+return_data.file_size+') <div class="goright resdelete" data-lid="'+data.lid+'" data-rid="'+return_data.file_id+'"><i class="goright fa fa-trash-o"></i></div></div>');
        $('#probar_status_'+data.lid).val(0);
      }else{

      }

    }
  });
}


// // Delete Course Section


function deletesection(id) {
  var _token=$('[name="_token"]').val();
  $('.section-'+id).css('opacity', '0.5');
  $.ajax ({
    type: "POST",
    url: $('[name="coursesectiondel"]').val(),
    data: "&courseid="+$('[name="course_id"]').val()+"&sid="+id+"&_token="+_token,
    success: function (msg)
    {
      
      $('.section-'+id).remove();
      $('.parent-s-'+id).remove();
      var x=1;
      $('.su_course_curriculam_sortable .su_gray_curr').each(function(){  
        $(this).find('.serialno').text(x);
        $(this).find('.sectionpos').val(x);
        x++;
      });
      updatesorting();
      //$('.su_course_add_section_content .col.col-lg-3 span').text($('.su_course_curriculam li.parentli').length+1);
    }
  });
}

// update course section

function updatesection(id) {
  $('.section-'+id).css('opacity','0.5');
  var section=$.trim($('.su_course_curriculam_sortable .section-'+id+' .su_course_update_section_textbox').val());
  console.log($('.su_course_curriculam_sortable .section-'+id+' .su_course_update_section_textbox'));
  console.log(id);
  if(section != ''){
    if(section.length < 2)
    {
      toastr.error('{!! Lang::get("curriculum.curriculum_section_ch_length") !!}');
      return false;
    }
    var position=$('.section-'+id+' .sectionpos').val();
    var coursesection=$('[name="coursesection"]').val();
    var _token=$('[name="_token"]').val();
    $.ajax ({
      type: "POST",
      url: coursesection,
      data: "&courseid="+$('[name="course_id"]').val()+"&section="+section+"&sid="+id+"&position="+position+"&_token="+_token,
      success: function (msg)
      {
        $('.section-'+id).css('opacity','1');
        console.log(section);
        $('.section-'+id+' label.slqtitle').text(section);
        $('.section-'+id).removeClass('editon');
        $('.section-'+id + ' .btn-edit-title').show();
      }
    });
  } else {
    toastr.error('{!! Lang::get("curriculum.curriculum_section_name") !!}');
  }
}

// Delete Course lecture

function deletelecture(id,sid) {
  var _token=$('[name="_token"]').val();
  $('.lecture-'+id).css('opacity','0.5');
  $.ajax ({
    type: "POST",
    url: $('[name="courselecturequizdel"]').val(),
    data: "&courseid="+$('[name="course_id"]').val()+"&lid="+id+"&_token="+_token,
    success: function (msg)
    {
      
      $('.lecture-'+id).remove();
      var x=1;
      $('.section-'+sid).nextUntil('.parentli', '.childli' ).each(function(){
        $(this).find('.serialno').text(x);
        x++;
      });
      var lq=1;
      $('.section-'+sid).nextUntil('.parentli', '.lq_sort' ).each(function(){
        $(this).find('.lecturepos').val(lq);
        lq++;
      });
      updatesorting();
      //$('.su_course_add_lecture_content .col.col-lg-3 span').text($('.su_course_curriculam li.childli').length+1);
    }
  });
}

// Delete Course quiz

function deletequiz(id,sid) {
  var _token=$('[name="_token"]').val();
  $('.quiz-'+id).css('opacity','0.5');
  $.ajax ({
    type: "POST",
    url: $('[name="courselecturequizdel"]').val(),
    data: "&courseid="+$('[name="course_id"]').val()+"&lid="+id+"&_token="+_token,
    success: function (msg)
    {
      
      $('.quiz-'+id).remove();
      var x=1;
      $('.section-'+sid).nextUntil('.parentli', '.quiz' ).each(function(){
        $(this).find('.serialno').text(x);
        x++;
      });
      var lq=1;
      $('.section-'+sid).nextUntil('.parentli', '.lq_sort_quiz' ).each(function(){
        $(this).find('.quizpos').val(lq);
        lq++;
      });
      updatesorting();
      //$('.su_course_add_quiz_content .col.col-lg-3 span').text($('.su_course_curriculam li.childli').length+1);
    }
  });
}

// update course lecture

function updatelecture(id,sid) {
  $('.lecture-'+id).css('opacity','0.5');
  var lecture=$.trim($('.lecture-'+id+' .su_course_update_lecture_textbox').val());
  if(lecture != ''){
    if(lecture.length<=1)
    {
      toastr.error('{!! Lang::get("curriculum.curriculum_lecture_ch_length")!!}');
      return false;
    }

    var position=$('.lecture-'+id+' .lecturepos').val();
    var courselecture=$('[name="courselecture"]').val();
    var _token=$('[name="_token"]').val();
    $.ajax ({
      type: "POST",
      url: courselecture,
      data: "&sectionid="+sid+"&courseid="+$('[name="course_id"]').val()+"&lecture="+lecture+"&lid="+id+"&position="+position+"&_token="+_token,
      success: function (msg)
      {
        $('.lecture-'+id).css('opacity','1');
        $('.lecture-'+id+' label.slqtitle').text(lecture);
        $('.lecture-'+id).removeClass('editon');
        $('.lecture-'+id + ' .btn-edit-title').show();
      }
    });
  } else {
    toastr.error('{!! Lang::get("curriculum.curriculum_lecture_name")!!}');
  }
}

function updatesorting() {
  var x=1;
  var updatesection=[];
  var updatelecturequiz=[];
  var lq=1;
  var y=1;
  var l=1;
  
  var sec_id = '';
  // Adding roll numbers for section and lectures
  $('.su_course_curriculam_sortable ul li').each(function(){
  
    if($(this).hasClass('parentli')){
      sec_id = $(this).find('.sectionid').val();
      
      $(this).find('.serialno').text(x);
      $(this).find('.sectionpos').val(x);
      var section= $(this).find('label').text();
      updatesection.push({
        section: section,
        id: sec_id,
        position: x
      });
      x++;
    } else if($(this).hasClass('childli')){
      var oldsid=$(this).find('.lecturesectionid').val();
      $(this).find('.serialno').text(y);
      $(this).find('.lecturepos').val(lq);
      $(this).find('.lecturesectionid').val(sec_id);
      
      var lid=$(this).find('.lectureid').val();
      
      $('.lecture-'+lid).removeClass('parent-s-'+oldsid);
      $('.lecture-'+lid).addClass('parent-s-'+sec_id);
      $('.lecture-'+lid+' .deletelecture').attr('onclick','deletelecture('+lid+','+sec_id+')');
      $('.lecture-'+lid+' .updatelecture').attr('onclick','updatelecture('+lid+','+sec_id+')');
      
      updatelecturequiz.push({
        sectionid: sec_id,
        id: lid,
        position: lq
      }); 
      y++;
      lq++;
    } else if($(this).hasClass('quiz')){
      var oldsid=$(this).find('.quizsectionid').val();
        
      $(this).find('.serialno').text(l);
      $(this).find('.quizpos').val(lq);
      $(this).find('.quizsectionid').val(sec_id)
      
      var lid=$(this).find('.quizid').val();

      $('.quiz-'+lid).removeClass('parent-s-'+oldsid);
      $('.quiz-'+lid).addClass('parent-s-'+sec_id);
      $('.quiz-'+lid+' .deletequiz').attr('onclick','deletequiz('+lid+','+sec_id+')');
      $('.quiz-'+lid+' .updatequiz').attr('onclick','updatequiz('+lid+','+sec_id+')');
      updatelecturequiz.push({
        sectionid: sec_id,
        id: lid,
        position: lq
      }); 
      l++;
      lq++;
    } 
  });
  
  // update the section position to db
  $.ajax ({
    type: "POST",
    url: $('[name="coursecurriculumsort"]').val(),
    data:{sectiondata: updatesection,_token:$('[name="_token"]').val(),type:'section'},
  });
  
  // update the lecture position to db
  $.ajax ({
    type: "POST",
    url: $('[name="coursecurriculumsort"]').val(),
    data:{lecturequizdata: updatelecturequiz,_token:$('[name="_token"]').val(),type:'lecturequiz'},
  });
}

function tinyClean(value) {
  value = value.replace(/&nbsp;/ig, ' ');
  value = value.replace(/\s\s+/g, ' ');
  if(value == '<p><br></p>' || value == '<p> </p>' || value == '<p></p>') {
    value = '';
  }
  return value;
}

//check url validation
function checkURL(link){
  var regexp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    return regexp.test(link); 
}
/*
$('body').on('click','.cclickable',function(){

  if(!$(this).hasClass('updaterescontent')) 
  {
    var id = $(this).attr('data-lid');
    if(id==null)
    {
      id = $(this).attr('data-id');
    }

    
     $.ajax({
        url: '{!! \URL::to("courses/video") !!}',
        data:{vid:id},
        method:'POST',
        success: function(result)
        {
            console.log("Vídeo - ", result);
            var storage_path = "{{ Storage::url('app/public/course/'.$course_id.'/') }}";
            var vi = '<source src="'+storage_path+result+'.mp4" type="video/mp4" id="videosource">';
            $('.video_p_'+id).html(vi);
          }
      });
  }
}); */
</script>
@endsection
