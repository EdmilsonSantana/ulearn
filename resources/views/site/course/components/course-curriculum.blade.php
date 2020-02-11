@if($is_curriculum)
<!-- curriculum block start -->
<h4 class="mt-4">Conteúdo do Curso</h4>

<div class="accordion mt-3 curriculum" id="accordionExample">

    @foreach($curriculum_sections as $curriculum_section => $curriculum_lectures)
    <?php
    $section_split = explode('{#-#}', $curriculum_section);
    $section_id = $section_split[0];
    $section_name = $section_split[1];
    ?>
    <div class="card mb-2">
        <div class="card-header" id="headingOne-{{ $section_id }}">
            <h5 class="mb-0">
                <button class="btn btn-acc-head" type="button" data-toggle="collapse" data-target="#collapseOne-{{ $section_id }}" aria-expanded="true" aria-controls="collapseOne-{{ $section_id }}">
                    <i class="fas @if($loop->first) fa-minus @else fa-plus @endif accordian-icon mr-2"></i><span>{{ $section_name }}</span>
                </button>
            </h5>
        </div>

        <div id="collapseOne-{{ $section_id }}" class="collapse @if($loop->first) show @endif" aria-labelledby="headingOne-{{ $section_id }}" data-parent="#accordionExample">
            <div class="container">

                @foreach($curriculum_lectures as $curriculum_lecture)
                @php
                switch ($curriculum_lecture->media_type) {
                case 0:
                $icon_class = 'fas fa-video';
                break;
                case 1:
                $icon_class = 'fas fa-headphones';
                break;
                case 2:
                $icon_class = 'far fa-file-pdf';
                break;
                case 3:
                $icon_class = 'far fa-file-alt';
                break;
                default:
                $icon_class = 'fas fa-video';
                }
                @endphp

                @if($is_subscribed)
                @php
                $is_completed = SiteHelpers::getCoursecompletedStatus($curriculum_lecture->lecture_quiz_id);
                @endphp
                @endif
                <div class="d-flex justify-content-between align-items-center lecture-container">
                    <div class="ml-4">
                        <div class="d-flex">
                            <div>
                                <i class="{{ $icon_class }} mr-2"></i>
                                <span>{{ $curriculum_lecture->l_title }}</span>
                            </div>
                            @if($is_subscribed)
                            <div class="ml-2">
                                @if($is_completed)
                                <i class="fas fa-check-circle" style=color:green;></i>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <span>
                            @if($curriculum_lecture->media_type == 2)
                            {{ $curriculum_lecture->f_duration.' Página(s)' }}
                            @elseif($curriculum_lecture->media_type == 0 || $curriculum_lecture->media_type == 1)
                            @if($curriculum_lecture->media_type == 0)
                            {{ $curriculum_lecture->v_duration }}
                            @else
                            {{ $curriculum_lecture->f_duration }}
                            @endif
                            @endif
                        </span>
                    </div>

                    <div>
                        <article class="preview-time">
                            @if($is_subscribed)

                            <a title="{{$is_completed ? 'Reiniciar Atividade' : 'Iniciar Atividade'}}" href="{{ url('course-enroll/'.$course->course_slug.'/'.SiteHelpers::encrypt_decrypt($curriculum_lecture->lecture_quiz_id,true)) }}" class="btn btn-ulearn-preview">
                                @if($is_completed)
                                <i class="fas fa-redo"></i>
                                @else
                                <i class="fas fa-play"></i>
                                @endif
                            </a>
                            @endif
                        </article>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

<script>
    window.addEventListener('load', function() {
        function toggleIcon(e) {
            $(e.target)
                .prev('.card-header')
                .find(".accordian-icon")
                .toggleClass('fa-plus fa-minus');
        }
        $('.accordion').on('hidden.bs.collapse', toggleIcon);
        $('.accordion').on('shown.bs.collapse', toggleIcon);
    });
</script>