@props(['class' => $class ?? ''])

<input type="checkbox" data-slot="checkbox" {{ $attributes->merge(['class' => $class]) }} />
