<?php

use App\Enums\SellerType;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders the nested seller product show page', function () {
    $seller = Seller::query()->create([
        'type' => SellerType::Business,
        'name' => 'Nested Seller',
        'business_email' => 'nested-seller@example.com',
        'phone' => '1234567890',
    ]);

    $product = Product::query()->create([
        'seller_id' => $seller->id,
        'name' => 'Nested Product',
        'description' => 'Testing the nested seller product route.',
    ]);

    $this->get(route('admin.seller.products.show', [
        'seller' => $seller,
        'product' => $product,
    ]))
        ->assertSuccessful()
        ->assertSee('Nested Product');
});
