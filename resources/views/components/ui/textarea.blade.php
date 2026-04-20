@props([
    'class' => $class ?? '',
    'value' => null,
])

@php
    $content = trim((string) $slot) !== '' ? $slot : $value;
@endphp

<textarea data-slot="textarea" {{ $attributes->except('value')->merge(['class' => $class]) }}>{{ $content }}</textarea>
