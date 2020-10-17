<div class="form-group{{ $label ? ' row' : null}}">
    @if($label)
        <label for="{{ $id }}" class="col-lg col-md-12 col-form-label border-right">
            {{ $label }}
        </label>
        <div class="col-lg col-md-12">
            <select {{ $attributes->merge(['class' => 'form-control', 'id' => $id]) }}>
                {{ $slot }}
            </select>
        </div>
    @else
        <select {{ $attributes->merge(['class' => 'form-control', 'id' => $id]) }}>
            {{ $slot }}
        </select>
    @endif
</div>
