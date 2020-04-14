<div class="modal" id="rateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bi-header">
                <h5 class="col-12 modal-title text-center bi-header-seperator-head">Como você classificaria este curso ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="rateCourseForm" class="form-horizontal" method="POST" action="{{ route('course.rate') }}">
                {{ csrf_field() }}
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <input type="hidden" name="rating" id="rating" value="{{ $course_rating->rating }}">
                <input type="hidden" name="rating_id" value="{{ $course_rating->id }}">
                <div class="px-4 py-2">

                    <div class="d-flex flex-column justify-content-center">
                        <div class="ml-auto mr-auto form-group">
                            <select class="form-control" id="barrating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group mt-5">
                            <textarea class="form-control form-control" placeholder="Conte-nos sobre sua experiência pessoal neste curso. Era o que você esperava ?" name="comments">{{ $course_rating->comments }}</textarea>
                        </div>

                        <div class="form-group mt-5">
                            <div class="d-flex flex-row justify-content-end">
                            @include('admin/components/button', ['type' => 'submit', 
                            'primary' => 'true', 'text' => $course_rating->id ? 'Atualizar' : 'Adicionar'])
                            @if($course_rating->id)
                                @include('admin/components/link', ['secondary' => true, 'link' => route('delete.rating', $course_rating->id), 'text' => 'Remover'])
                            @endif
                            </div>
                        </div>

                    </div>

                    <!-- <div class="row">
                            
                            <div class="col-5">
                                @if($course_rating->id)
                                <a class="btn btn-sm btn-block delete-review delete-record" href="{{ route('delete.rating', $course_rating->id) }}">Remover classificação</a>
                                @endif
                            </div>
                        </div>-->



                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.addEventListener('load', function() {

        $("#barrating").barrating({
            theme: 'fontawesome-stars',
            @if($course_rating->id)
            initialRating: '{{ $course_rating->rating }}',
            @endif
            onSelect: function(rating) {
                console.log(rating);
                $('#rating').val(rating);
            }
        });
    });
</script>