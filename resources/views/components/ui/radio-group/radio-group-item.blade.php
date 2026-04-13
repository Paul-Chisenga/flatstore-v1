@props(['class' => $class ?? ''])

<input type="radio" data-slot="radio-group-item" {{ $attributes->merge(['class' => $class]) }} />
