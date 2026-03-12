@props(['class' => $class ?? ''])

<section {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</section>
