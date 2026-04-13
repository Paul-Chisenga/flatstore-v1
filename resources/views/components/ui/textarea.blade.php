@props(['class' => $class ?? ''])

<textarea data-slot="textarea" {{ $attributes->merge(['class' => $class]) }}></textarea>
