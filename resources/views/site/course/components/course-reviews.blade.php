@if(count($course->ratings)>0)
<section class="mt-5">
    <h4 class="mb-3">Comentários</h4>

    <div class="reviews-container">
        @foreach($course->ratings as $rating)
        <div class="review-row row mx-0">
            <div class="col-3">
                <div class="row">
                    <div class="review-avatar mr-2">
                        <div class="review-avatar-span">
                            {{ $rating->user->first_name[0].$rating->user->last_name[0] }}
                        </div>
                    </div>
                    <div class="review-time-block">
                        <div class="review-time">
                            {{ $rating->updated_at->diffForHumans() }}
                        </div>
                        <span>{{ $rating->user->first_name.' '.$rating->user->last_name }}</span>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <star class="course-rating">
                    @for($r=1;$r<=5;$r++) <span class="fa fa-star {{ $r <= $rating->rating ? 'checked' : ''}}"></span>
                        @endfor

                </star>
                <p class="mt-1">{{ $rating->comments }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif