@php
    $slotContent = trim((string) $slot);
    $hasCustomContent = $slotContent !== '';
    // $messages = $messages ?? [];
@endphp


@if ($hasCustomContent || !empty($messages))
    <div role="alert" data-slot="field-error" {{ $attributes->merge(['class' => $class]) }}>
        @if ($hasCustomContent)
            {{ $slot }}
        @elseif (count($messages) === 1)
            {{ $messages[0] }}
        @else
            <ul class="ml-4 flex list-disc flex-col gap-1">
                @foreach ($messages as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif
