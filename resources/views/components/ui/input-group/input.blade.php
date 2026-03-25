@props(['class' => $class ?? ''])

<input data-slot="input-group-control" {{ $attributes->merge(['class' => $class]) }} />
