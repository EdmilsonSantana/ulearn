<div class="card card-block p-30 bg-{{ $bg_color }}-600">
    <div class="card-watermark darker font-size-80 m-15"><i class="{{ $icon }}" aria-hidden="true"></i></div>
    <div class="counter counter-md counter-inverse text-left">
        <div class="counter-number-group">
            <span class="counter-number">{{ $metric }}</span>
            <span class="counter-number-related text-capitalize">{{ str_plural($label, $metric) }}</span>
        </div>
    </div>
</div>