@props([
    'action',
    'title',
    'description',
    'alert_title' => null,
    'alert_description' => null,
    'submit_label' => null,
    'attribute' => null,
])

@php
    /** @var App\Models\ProductAttribute|null $attribute */
@endphp

<x-common.form-card :isEdit="$attribute !== null" :action="$action" :title="$title" :description="$description" :alert_title="$alert_title"
    :alert_description="$alert_description" :submit_label="$submit_label">
    <x-ui.field.field-group>
        <x-ui.field>
            <x-ui.field.field-label for="name">Attribute Name</x-ui.field.field-label>
            <x-ui.input id="name" name="name" type="text" :value="old('name', $attribute?->name)" placeholder="Eg. Color" />
            <x-ui.field.field-error :messages="$errors->get('name')" />
        </x-ui.field>
        <x-ui.field>
            <x-ui.field.field-label for="values">Attribute Values</x-ui.field.field-label>
            <x-ui.input id="values" name="values" type="text" :value="old('values', $attribute?->values->pluck('value')->join(', '))" placeholder="Eg. Red, Blue, Green" />
            <x-ui.field.field-error :messages="$errors->get('values')" />
        </x-ui.field>
    </x-ui.field.field-group>
</x-common.form-card>
