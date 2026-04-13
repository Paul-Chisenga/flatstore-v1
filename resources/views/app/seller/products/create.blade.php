<x-seller.root>
    <x-seller.page-header title="Create Product" description="Manage your store's products." />

    <x-ui.card class="mt-8">
        <x-ui.card.card-header>
            <x-ui.card.card-title>
                Create a new product
            </x-ui.card.card-title>
            <x-ui.card.card-description .card-description>
                Fill in the details below to create a new product.
            </x-ui.card.card-description>
        </x-ui.card.card-header>
        <x-ui.card.card-content>
            <form action="{{ route('seller.products.store') }}" method="POST" class="space-y-6">
                @csrf
                <x-ui.field.field>
                    <x-ui.field.field-label for="name">Name</x-ui.field.field-label>
                    <x-ui.input id="name" name="name" :value="old('name')" autofocus />
                    <x-ui.field.field-error :messages="$errors->get('name')" />
                </x-ui.field.field>
                <x-ui.field.field>
                    <x-ui.field.field-label for="description">Description</x-ui.field.field-label>
                    <x-ui.textarea id="description" name="description" :value="old('description')" />
                    <x-ui.field.field-error :messages="$errors->get('description')" />
                </x-ui.field.field>
                <div class="flex justify-end">
                    <x-ui.button type="submit">
                        Create Product
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card.card-content>
        </x-ui.card.card>
</x-seller.root>
