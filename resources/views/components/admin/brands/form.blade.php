@props(['brand'])


<x-admin.root>
    <x-admin.page-header title="{{ $brand ? $brand->name : 'Create Brand' }}"
        description="{{ $brand ? null : 'Fill in the details below to create a new brand.' }}" />

    <x-ui.card class="mt-8">
        <x-ui.card.card-header>
            <x-ui.card.card-title>
                {{ $brand ? 'Edit Brand' : 'Create a new brand' }}
            </x-ui.card.card-title>
            <x-ui.card.card-description .card-description>
                {{ $brand ? 'Update the details of your brand below.' : 'Fill in the details below to create a new brand.' }}
            </x-ui.card.card-description>
            {{-- Error --}}
            @error('error')
                <x-ui.alert.alert variant="destructive">
                    <x-ui.alert.alert-title>{{ $brand ? 'Brand Update Failed' : 'Brand Creation Failed' }}</x-ui.alert.alert-title>
                    <x-ui.alert.alert-description>
                        {{ $message }}
                    </x-ui.alert.alert-description>
                </x-ui.alert.alert>
            @enderror
        </x-ui.card.card-header>
        <x-ui.card.card-content>
            <form action="{{ $brand ? route('admin.brands.update', $brand) : route('admin.brands.store') }}"
                method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @if ($brand)
                    @method('PUT')
                @endif
                <x-ui.field.field>
                    <x-ui.field.field-label for="name">Name</x-ui.field.field-label>
                    <x-ui.input id="name" name="name" :value="old('name', $brand ? $brand->name : '')" autofocus />
                    <x-ui.field.field-error :messages="$errors->get('name')" />
                </x-ui.field.field>
                <x-ui.field.field>
                    <x-ui.field.field-label for="logo">Logo</x-ui.field.field-label>
                    <x-ui.input id="logo" name="logo" type="file" />
                    <x-ui.field.field-error :messages="$errors->get('logo')" />
                </x-ui.field.field>
                <x-ui.field.field>
                    <x-ui.field.field-label for="description">Description</x-ui.field.field-label>
                    <x-ui.input id="description" name="description" :value="old('description', $brand ? $brand->description : '')" />
                    <x-ui.field.field-error :messages="$errors->get('description')" />
                </x-ui.field.field>
                <div class="flex justify-end">
                    <x-ui.button type="submit">
                        {{ $brand ? 'Update Brand' : 'Create Brand' }}
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card.card-content>
        </x-ui.card.card>
</x-admin.root>
