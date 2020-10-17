<div class="form-group{{ $label ? ' row' : null}}">
    @if($label)
        <label for="{{ $id }}" class="col-lg col-md-12 col-form-label border-right">
            {{ $label }}
        </label>
        <div class="col-lg col-md-12">
            <input {{ $attributes->merge(['class' => 'form-control', 'type' => $type, 'id' => $id]) }}>
            {{ $slot }}
        </div>
    @else
        <input {{ $attributes->merge(['class' => 'form-control', 'type' => $type, 'id' => $id]) }}>

        {{ $slot }}
    @endif
</div>
