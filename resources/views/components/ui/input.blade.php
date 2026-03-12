@props(['class' => $class ?? ''])

<input data-slot="input" {{ $attributes->merge(['class' => $class]) }} />
