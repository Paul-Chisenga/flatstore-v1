@props(['class' => $class ?? ''])

<div {{ $attributes->merge(['class' => $class]) }}></div>
