<div {{ $attributes->merge(['class' => 'card']) }}>
    @if($header)
        <div class="card-header bg-transparent d-flex align-items-center">
            {{ $header }}
        </div>
    @endif

    <div class="card-body">
        {{ $body ?: $slot }}
    </div>

    @if($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
