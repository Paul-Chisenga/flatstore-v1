@props(['class' => $class ?? ''])

<select data-slot="select" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</select>
