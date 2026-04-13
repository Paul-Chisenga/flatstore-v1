@props(['class' => $class ?? ''])

<img data-slot="avatar-image" {{ $attributes->merge(['class' => $class]) }} />
