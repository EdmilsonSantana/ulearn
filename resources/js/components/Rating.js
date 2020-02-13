import React from 'react';

const Rating = (props) => {

    
    const course = this.props.course;
    const course_rating = this.props.course_rating;

    return (
        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bi-header ">
                        <h5 class="col-12 modal-title text-center bi-header-seperator-head">Avalie o curso</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="becomeInstructorForm">
                        <form id="rateCourseForm" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="course_id" value="{{ $course->id }}" />
                            <input type="hidden" name="rating" id="rating" value="{{ $course_rating->rating }}" />
                            <input type="hidden" name="rating_id" value="{{ $course_rating->id }}" />
                            <div class="px-4 py-2">
                                <div class="form-group">
                                    <label>Sua Avaliação</label>
                                    <div class="row">
                                        <div class="col-7 pl-2">
                                            <div id="rateYo"></div>
                                        </div>
                                        <div class="col-5">
                                            @if($course_rating->id)
                                            <a class="btn btn-sm btn-block delete-review delete-record" href="{{ route('delete.rating', $course_rating->id) }}">Delete Review</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Seu Comentário</label>
                                    <textarea class="form-control form-control" placeholder="Comments" name="comments">{{ $course_rating->comments }}</textarea>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-lg btn-block login-page-button">{{ $course_rating->id ? 'Update' : 'Add' }} Review</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    );
};

export default Rating;