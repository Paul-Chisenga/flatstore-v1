{{-- By default, this form is used for creating a new seller as an owner --}}
<x-admin.root>
    <x-admin.page-header title="Create Seller" description="Manage your store's sellers." />
    <form action="{{ route('admin.sellers.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        <x-ui.card class="mt-8">
            <x-ui.card.card-header>
                <x-ui.card.card-title>
                    Create a new seller
                </x-ui.card.card-title>
                <x-ui.card.card-description>
                    Fill in the details below to create a new seller.
                </x-ui.card.card-description>
                {{-- Error --}}
                @error('error')
                    <x-ui.alert.alert variant="destructive">
                        <x-ui.alert.alert-title>{{ 'Seller Creation Failed' }}</x-ui.alert.alert-title>
                        <x-ui.alert.alert-description>
                            {{ $message }}
                        </x-ui.alert.alert-description>
                    </x-ui.alert.alert>
                @enderror
            </x-ui.card.card-header>
            <x-ui.card.card-content class="grid grid-cols-3 gap-6">
                {{-- Seller details --}}
                <x-ui.card>
                    <x-ui.card.card-header>
                        <x-ui.card.card-title>
                            Business Details
                        </x-ui.card.card-title>
                        <x-ui.card.card-description>
                            Basic information about the business.
                        </x-ui.card.card-description>
                    </x-ui.card.card-header>
                    <x-ui.card.card-content class="space-y-4">
                        {{-- Business Type --}}
                        <x-ui.field.field-set>
                            <x-ui.field.field-legend>Business type</x-ui.field.field-legend>
                            <x-ui.field.field-description>Select the type of business for the
                                seller.</x-ui.field.field-description>
                            <x-ui.radio-group.radio-group>
                                <x-ui.field orientation="horizontal">
                                    <x-ui.radio-group.radio-group-item id="business" name="business_type"
                                        value="business" />
                                    <x-ui.field.field-label for="business">Business</x-ui.field.field-label>
                                </x-ui.field>
                                <x-ui.field orientation="horizontal">
                                    <x-ui.radio-group.radio-group-item id="individual" name="business_type"
                                        value="individual" />
                                    <x-ui.field.field-label for="individual">Individual</x-ui.field.field-label>
                                </x-ui.field>
                            </x-ui.radio-group.radio-group>
                            <x-ui.field.field-error :messages="$errors->get('business_type')" />
                        </x-ui.field.field-set>
                        {{-- Seller role --}}
                        <x-ui.field.field-set>
                            <x-ui.field.field-legend>Role</x-ui.field.field-legend>
                            <x-ui.field.field-description>Select the role for the seller.</x-ui.field.field-description>
                            <x-ui.radio-group.radio-group>
                                <x-ui.field orientation="horizontal">
                                    <x-ui.radio-group.radio-group-item id="owner" name="seller_role"
                                        value="{{ App\Enums\SellerRole::Owner->value }}" />
                                    <x-ui.field.field-label
                                        for="owner">{{ App\Enums\SellerRole::Owner->label() }}</x-ui.field.field-label>
                                </x-ui.field>
                                <x-ui.field orientation="horizontal">
                                    <x-ui.radio-group.radio-group-item id="manager" name="seller_role"
                                        value="{{ App\Enums\SellerRole::Manager->value }}" />
                                    <x-ui.field.field-label
                                        for="manager">{{ App\Enums\SellerRole::Manager->label() }}</x-ui.field.field-label>
                                </x-ui.field>
                                <x-ui.field orientation="horizontal">
                                    <x-ui.radio-group.radio-group-item id="staff" name="seller_role"
                                        value="{{ App\Enums\SellerRole::Staff->value }}" />
                                    <x-ui.field.field-label
                                        for="staff">{{ App\Enums\SellerRole::Staff->label() }}</x-ui.field.field-label>
                                </x-ui.field>
                            </x-ui.radio-group.radio-group>
                            <x-ui.field.field-error :messages="$errors->get('seller_role')" />
                        </x-ui.field.field-set>
                        {{-- Seller name --}}
                        <x-ui.field.field>
                            <x-ui.field.field-content>
                                <x-ui.field.field-label for="business_name">Business Name</x-ui.field.field-label>
                                <x-ui.field.field-description for="business_name">Either the business name(for a store)
                                    or
                                    the owner's name(for an individual).</x-ui.field.field-description>
                            </x-ui.field.field-content>
                            <x-ui.input id="business_name" name="business_name" type="text" :value="old('business_name', 'Shoprite')"
                                placeholder="Eg. Shoprite; Mary Lane" />
                            <x-ui.field.field-error :messages="$errors->get('business_name')" />
                        </x-ui.field.field>
                        {{-- Business email --}}
                        <x-ui.field.field>
                            <x-ui.field.field-label for="business_email">Business Email</x-ui.field.field-label>
                            <x-ui.input id="business_email" name="business_email" type="email" :value="old('business_email', 'shoprite@example.com')" />
                            <x-ui.field.field-error :messages="$errors->get('business_email')" />
                        </x-ui.field.field>
                        {{-- Business phone number --}}
                        <x-ui.field.field>
                            <x-ui.field.field-label for="business_phone">Business Phone Number</x-ui.field.field-label>
                            <x-ui.input id="business_phone" name="business_phone" type="tel" :value="old('business_phone', '+1234567890')" />
                            <x-ui.field.field-error :messages="$errors->get('business_phone')" />
                        </x-ui.field.field>
                        {{-- Business logo --}}
                        <x-ui.field.field>
                            <x-ui.field.field-label for="logo">Business Logo (optional)</x-ui.field.field-label>
                            <x-ui.input id="logo" name="logo" type="file" />
                            <x-ui.field.field-error :messages="$errors->get('logo')" />
                        </x-ui.field.field>
                    </x-ui.card.card-content>
                </x-ui.card>
                {{-- Business credentials --}}

                <div class="space-y-4">
                    <x-ui.card>
                        <x-ui.card.card-header>
                            <x-ui.card.card-title>
                                Login Details
                            </x-ui.card.card-title>
                            <x-ui.card.card-description>
                                Login credentials for the business.
                            </x-ui.card.card-description>
                        </x-ui.card.card-header>
                        <x-ui.card.card-content class="space-y-4">
                            <x-ui.field.field>
                                <x-ui.field.field-label for="email">Email</x-ui.field.field-label>
                                <x-ui.input id="email" name="email" type="email" :value="old('email', 'shoprite@example.com')" />
                                <x-ui.field.field-error :messages="$errors->get('email')" />
                            </x-ui.field.field>
                            <x-ui.field.field>
                                <x-ui.field.field-label for="password">Password</x-ui.field.field-label>
                                <x-ui.input id="password" name="password" type="password" :value="old('password', 'password123')" />
                                <x-ui.field.field-error :messages="$errors->get('password')" />
                            </x-ui.field.field>
                        </x-ui.card.card-content>
                    </x-ui.card>
                    <x-ui.card>
                        <x-ui.card.card-header>
                            <x-ui.card.card-title>
                                Contact Person Details
                            </x-ui.card.card-title>
                            <x-ui.card.card-description>
                                Additional profile information for the contact person.
                            </x-ui.card.card-description>
                        </x-ui.card.card-header>
                        <x-ui.card.card-content class="space-y-4">
                            <x-ui.field.field>
                                <x-ui.field.field-label for="first_name">First Name</x-ui.field.field-label>
                                <x-ui.input id="first_name" name="first_name" type="text" :value="old('first_name', 'John')" />
                                <x-ui.field.field-error :messages="$errors->get('first_name')" />
                            </x-ui.field.field>
                            <x-ui.field.field>
                                <x-ui.field.field-label for="last_name">Last Name</x-ui.field.field-label>
                                <x-ui.input id="last_name" name="last_name" type="text" :value="old('last_name', 'Doe')" />
                                <x-ui.field.field-error :messages="$errors->get('last_name')" />
                            </x-ui.field.field>
                            <x-ui.field.field>
                                <x-ui.field.field-label for="contact_email">Email</x-ui.field.field-label>
                                <x-ui.input id="contact_email" name="contact_email" type="email" :value="old('contact_email', 'johndoe@example.com')" />
                                <x-ui.field.field-error :messages="$errors->get('contact_email')" />
                            </x-ui.field.field>
                            <x-ui.field.field>
                                <x-ui.field.field-label for="contact_phone">Phone
                                    Number</x-ui.field.field-label>
                                <x-ui.input id="contact_phone" name="contact_phone" type="tel" :value="old('contact_phone', '+1234567890')" />
                                <x-ui.field.field-error :messages="$errors->get('contact_phone')" />
                            </x-ui.field.field>
                            <x-ui.field.field>
                                <x-ui.field.field-label for="birth_date">Date of Birth</x-ui.field.field-label>
                                <x-ui.input id="birth_date" name="birth_date" type="date" :value="old('birth_date')" />
                                <x-ui.field.field-error :messages="$errors->get('birth_date')" />
                            </x-ui.field.field>
                        </x-ui.card.card-content>
                    </x-ui.card>
                </div>
                {{-- Contact person profile --}}
                <x-ui.card>
                    <x-ui.card.card-header>
                        <x-ui.card.card-title>
                            Primary Store
                        </x-ui.card.card-title>
                        <x-ui.card.card-description>
                            You can add more stores later.
                        </x-ui.card.card-description>
                    </x-ui.card.card-header>
                    <x-ui.card.card-content class="space-y-4">
                        <x-ui.field.field-set>
                            {{-- Store name --}}
                            <x-ui.field.field>
                                <x-ui.field.field-label for="store_name">Store Name</x-ui.field.field-label>
                                <x-ui.input id="store_name" name="store_name" type="text" :value="old('store_name', 'Shoprite MandaHill')" />
                                <x-ui.field.field-error :messages="$errors->get('store_name')" />
                            </x-ui.field.field>
                            {{-- Store email --}}
                            <x-ui.field.field>
                                <x-ui.field.field-label for="store_email">Store Email
                                    (optional)</x-ui.field.field-label>
                                <x-ui.input id="store_email" name="store_email" type="email" :value="old('store_email')" />
                                <x-ui.field.field-error :messages="$errors->get('store_email')" />
                            </x-ui.field.field>
                            {{-- Store phone number --}}
                            <x-ui.field.field>
                                <x-ui.field.field-label for="store_phone">Store Phone Number
                                    (optional)</x-ui.field.field-label>
                                <x-ui.input id="store_phone" name="store_phone" type="tel" :value="old('store_phone')" />
                                <x-ui.field.field-error :messages="$errors->get('store_phone')" />
                            </x-ui.field.field>
                            {{-- Store logo --}}
                            <x-ui.field.field>
                                <x-ui.field.field-label for="store_logo">Store Logo (optional)</x-ui.field.field-label>
                                <x-ui.input id="store_logo" name="store_logo" type="file" />
                                <x-ui.field.field-error :messages="$errors->get('store_logo')" />
                            </x-ui.field.field>
                        </x-ui.field.field-set>
                        <x-ui.field.field-set>
                            <x-ui.field.field-legend>Store Location</x-ui.field.field-legend>
                            <x-ui.field.field-description>
                                The physical address of the store.
                            </x-ui.field.field-description>
                            <x-ui.field.field-group>
                                <x-ui.field.field>
                                    <x-ui.field.field-label for="country">Country</x-ui.field.field-label>
                                    <x-ui.input id="country" name="country" type="text" :value="old('country', 'Zambia')" />
                                    <x-ui.field.field-error :messages="$errors->get('country')" />
                                </x-ui.field.field>
                                <x-ui.field.field>
                                    <x-ui.field.field-label for="state">State/Province</x-ui.field.field-label>
                                    <x-ui.input id="state" name="state" type="text" :value="old('state', 'Lusaka')" />
                                    <x-ui.field.field-error :messages="$errors->get('state')" />
                                </x-ui.field.field>
                                <x-ui.field.field>
                                    <x-ui.field.field-label for="city">City</x-ui.field.field-label>
                                    <x-ui.input id="city" name="city" type="text" :value="old('city', 'Lusaka')" />
                                    <x-ui.field.field-error :messages="$errors->get('city')" />
                                </x-ui.field.field>
                                <x-ui.field.field>
                                    <x-ui.field.field-label for="street">Street</x-ui.field.field-label>
                                    <x-ui.input id="street" name="street" type="text" :value="old('street', 'great east road')" />
                                    <x-ui.field.field-error :messages="$errors->get('street')" />
                                </x-ui.field.field>
                                <x-ui.field.field>
                                    <x-ui.field.field-label for="postal_code">Postal Code
                                        (optional)</x-ui.field.field-label>
                                    <x-ui.input id="postal_code" name="postal_code" type="text"
                                        :value="old('postal_code')" />
                                    <x-ui.field.field-error :messages="$errors->get('postal_code')" />
                                </x-ui.field.field>
                            </x-ui.field.field-group>
                        </x-ui.field.field-set>
                    </x-ui.card.card-content>
                </x-ui.card>
            </x-ui.card.card-content>
            <x-ui.card.card-footer class="justify-end">
                <x-ui.button type="submit">
                    Create Seller
                </x-ui.button>
            </x-ui.card.card-footer>
            </x-ui.card.card>
    </form>
</x-admin.root>
