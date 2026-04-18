<?php

use App\Enums\SellerType;
use App\Models\Seller;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders the nested seller store show page', function () {
    $seller = Seller::query()->create([
        'type' => SellerType::Business,
        'name' => 'Acme Seller',
        'business_email' => 'seller@example.com',
        'phone' => '1234567890',
    ]);

    $store = Store::query()->create([
        'seller_id' => $seller->id,
        'name' => 'Main Store',
    ]);

    $this->get(route('admin.seller.stores.show', [
        'seller' => $seller,
        'store' => $store,
    ]))
        ->assertSuccessful()
        ->assertSee('Main Store');
});
