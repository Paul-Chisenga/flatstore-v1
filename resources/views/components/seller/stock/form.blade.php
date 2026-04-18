@props([
    'action',
    'title',
    'description',
    'alert_title' => null,
    'alert_description' => null,
    'submit_label' => null,
    'available_stores' => [],
])

@php
    /** @var App\Models\Store[] $available_stores */
@endphp

<x-common.form-card :isEdit="false" :action="$action" :title="$title" :description="$description" :alert_title="$alert_title"
    :alert_description="$alert_description" :submit_label="$submit_label">
    <x-ui.field.field-group>
        <x-ui.field>
            <x-ui.field.field-label for="store_id">Store</x-ui.field.field-label>
            <x-ui.select id="store_id" name="store_id" :value="old('store_id')" placeholder="Eg. Main Store">
                <option value="">{{ $available_stores->isEmpty() ? 'No store available' : 'Select a store' }}
                </option>
                @foreach ($available_stores as $store)
                    <option value="{{ $store->id }}" @selected(old('store_id') == $store->id)>
                        {{ $store->name }}
                    </option>
                @endforeach
            </x-ui.select>
            <x-ui.field.field-error :messages="$errors->get('store_id')" />
        </x-ui.field>
        <x-ui.field>
            <x-ui.field.field-content>
                <x-ui.field.field-label for="stock">Stock</x-ui.field.field-label>
                <x-ui.field.field-description>Enter the available stock quantity for this variation in the selected
                    store.</x-ui.field.field-description>
            </x-ui.field.field-content>
            <x-ui.input id="stock" name="stock" type="number" :value="old('stock')" placeholder="Eg. 100" />
            <x-ui.field.field-error :messages="$errors->get('stock')" />
        </x-ui.field>
    </x-ui.field.field-group>
</x-common.form-card>
