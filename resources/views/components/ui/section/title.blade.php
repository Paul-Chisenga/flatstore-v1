@props(['class' => $class ?? ''])

<h1 {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</h1>
