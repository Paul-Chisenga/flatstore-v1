@props([
    'action',
    'title',
    'description',
    'alert_title' => null,
    'alert_description' => null,
    'submit_label' => null,
    'isEdit' => false,
    'enctype' => null,
])

<form action="{{ $action }}" method="POST" @if ($enctype) enctype="{{ $enctype }}" @endif>
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif
    <x-ui.card class="mt-8">
        <x-ui.card.card-header>
            <x-ui.card.card-title>
                {{ $title }}
            </x-ui.card.card-title>
            <x-ui.card.card-description>
                {{ $description }}
            </x-ui.card.card-description>
            {{-- Error --}}
            @error('error')
                <x-ui.alert.alert variant="destructive">
                    <x-ui.alert.alert-title>{{ $alert_title ?? 'An error occurred' }}</x-ui.alert.alert-title>
                    <x-ui.alert.alert-description>
                        {{ $alert_description ?? $message }}
                    </x-ui.alert.alert-description>
                </x-ui.alert.alert>
            @enderror
        </x-ui.card.card-header>
        <x-ui.card.card-content>
            {{ $slot }}
        </x-ui.card.card-content>
        <x-ui.card.card-footer class="justify-end">
            <x-ui.button type="submit">
                {{ $submit_label ?? 'Submit' }}
            </x-ui.button>
        </x-ui.card.card-footer>
    </x-ui.card>
</form>
