@props(['sellers', 'seller_id', 'store' => null])

@php
    /** @var App\Models\Seller[] $sellers */
    /** @var int|null $seller_id */
    /** @var App\Models\Store|null $store */

    $seller_id ??= old('seller_id') ?? $store?->seller_id;
    $action = $store
        ? route('admin.seller.stores.update', ['seller' => $store->seller, 'store' => $store])
        : route('admin.seller.stores.store', ['seller' => $seller_id]);
    $method = $store ? 'PUT' : 'POST';
    $title = $store ? 'Edit Store' : 'Create Store';
    $description = $store ? 'Edit the details of your store.' : 'Fill in the details below to create a new store.';
@endphp

<x-admin.root>
    <x-admin.page-header :title="$title" description="Manage your store's stores." />
    <form action="{{ $action }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @if ($store)
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
                        <x-ui.alert.alert-title>{{ $title }} Failed</x-ui.alert.alert-title>
                        <x-ui.alert.alert-description>
                            {{ $message }}
                        </x-ui.alert.alert-description>
                    </x-ui.alert.alert>
                @enderror
            </x-ui.card.card-header>
            <x-ui.card.card-content class="grid grid-cols-3 gap-6">
                {{-- Store details --}}
                <x-ui.card>
                    <x-ui.card.card-header>
                        <x-ui.card.card-title>
                            Store Details
                        </x-ui.card.card-title>
                        <x-ui.card.card-description>
                            Basic information about the store.
                        </x-ui.card.card-description>
                    </x-ui.card.card-header>
                    <x-ui.card.card-content class="space-y-4">
                        {{-- Seller --}}
                        <x-ui.field.field>
                            <x-ui.field.field-label for="seller_id">Seller</x-ui.field.field-label>
                            <x-ui.select id="seller_id" name="seller_id">
                                <option value="">Select a seller</option>
                                @foreach ($sellers as $seller)
                                    <option value="{{ $seller->id }}"
                                        {{ $seller_id == $seller->id ? 'selected' : '' }}>
                                        {{ $seller->name }}
                                    </option>
                                @endforeach
                            </x-ui.select>
                            <x-ui.field.field-error :messages="$errors->get('seller_id')" />
                        </x-ui.field.field>
                        {{-- Store name --}}
                        <x-ui.field.field>
                            <x-ui.field.field-label for="store_name">Store Name</x-ui.field.field-label>
                            <x-ui.input id="store_name" name="store_name" type="text" :value="old('store_name', $store?->name ?? 'Shoprite MandaHill')" />
                            <x-ui.field.field-error :messages="$errors->get('store_name')" />
                        </x-ui.field.field>
                        {{-- Store email --}}
                        <x-ui.field.field>
                            <x-ui.field.field-label for="store_email">Store Email (optional)</x-ui.field.field-label>
                            <x-ui.input id="store_email" name="store_email" type="email" :value="old('store_email', $store?->email)" />
                            <x-ui.field.field-error :messages="$errors->get('store_email')" />
                        </x-ui.field.field>
                        {{-- Store phone number --}}
                        <x-ui.field.field>
                            <x-ui.field.field-label for="store_phone">Store Phone Number
                                (optional)</x-ui.field.field-label>
                            <x-ui.input id="store_phone" name="store_phone" type="tel" :value="old('store_phone', $store?->phone)" />
                            <x-ui.field.field-error :messages="$errors->get('store_phone')" />
                        </x-ui.field.field>
                        {{-- Store logo --}}
                        <x-ui.field.field>
                            <x-ui.field.field-label for="logo">Store Logo (optional)</x-ui.field.field-label>
                            <x-ui.input id="logo" name="logo" type="file" />
                            <x-ui.field.field-error :messages="$errors->get('logo')" />
                        </x-ui.field.field>
                    </x-ui.card.card-content>
                </x-ui.card>
                {{-- Address --}}
                <x-ui.card>
                    <x-ui.card.card-header>
                        <x-ui.card.card-title>
                            Store address
                        </x-ui.card.card-title>
                        <x-ui.card.card-description>
                            The physical address of the store.
                        </x-ui.card.card-description>
                    </x-ui.card.card-header>
                    <x-ui.card.card-content class="space-y-4">
                        <x-ui.field.field>
                            <x-ui.field.field-label for="country">Country</x-ui.field.field-label>
                            <x-ui.input id="country" name="country" type="text" :value="old('country', $store?->address->country ?? 'zambia')" />
                            <x-ui.field.field-error :messages="$errors->get('country')" />
                        </x-ui.field.field>
                        <x-ui.field.field>
                            <x-ui.field.field-label for="state">State/Province</x-ui.field.field-label>
                            <x-ui.input id="state" name="state" type="text" :value="old('state', $store?->address->state ?? 'Lusaka')" />
                            <x-ui.field.field-error :messages="$errors->get('state')" />
                        </x-ui.field.field>
                        <x-ui.field.field>
                            <x-ui.field.field-label for="city">City</x-ui.field.field-label>
                            <x-ui.input id="city" name="city" type="text" :value="old('city', $store?->address->city ?? 'Lusaka')" />
                            <x-ui.field.field-error :messages="$errors->get('city')" />
                        </x-ui.field.field>
                        <x-ui.field.field>
                            <x-ui.field.field-label for="street">Street</x-ui.field.field-label>
                            <x-ui.input id="street" name="street" type="text" :value="old('street', $store?->address->street)" />
                            <x-ui.field.field-error :messages="$errors->get('street')" />
                        </x-ui.field.field>
                        <x-ui.field.field>
                            <x-ui.field.field-label for="postal_code">Postal Code (optional)</x-ui.field.field-label>
                            <x-ui.input id="postal_code" name="postal_code" type="text" :value="old('postal_code', $store?->address->postal_code)" />
                            <x-ui.field.field-error :messages="$errors->get('postal_code')" />
                        </x-ui.field.field>
                    </x-ui.card.card-content>
                </x-ui.card>
            </x-ui.card.card-content>
            <x-ui.card.card-footer class="justify-end">
                <x-ui.button type="submit">
                    {{ $title }}
                </x-ui.button>
            </x-ui.card.card-footer>
            </x-ui.card.card>
    </form>
</x-admin.root>
