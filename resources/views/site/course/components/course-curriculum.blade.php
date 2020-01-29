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
                <div class="row lecture-container">
                    <div class="col-8 my-auto ml-4">
                        <i class="{{ $icon_class }} mr-2"></i>
                        <span>{{ $curriculum_lecture->l_title }}</span>
                    </div>
                    <div class="col-3 my-auto">
                        <article class="preview-time">
                            <span>
                                @if($curriculum_lecture->media_type == 2)
                                {{ $curriculum_lecture->f_duration.' Pages' }}
                                @elseif($curriculum_lecture->media_type == 0 || $curriculum_lecture->media_type == 1)
                                @if($curriculum_lecture->media_type == 0)
                                {{ $curriculum_lecture->v_duration }}
                                @else
                                {{ $curriculum_lecture->f_duration }}
                                @endif
                                @endif
                            </span>
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