<?php

use App\Enums\SellerType;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Seller;
use App\Models\Store;
use App\Models\StoreVariationStock;
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

it('shows inventory insights for a store', function () {
    $seller = Seller::query()->create([
        'type' => SellerType::Business,
        'name' => 'Inventory Seller',
        'business_email' => 'inventory@example.com',
        'phone' => '1234567891',
    ]);

    $store = Store::query()->create([
        'seller_id' => $seller->id,
        'name' => 'Warehouse One',
    ]);

    $product = Product::query()->create([
        'seller_id' => $seller->id,
        'name' => 'Classic Tee',
    ]);

    $variation = ProductVariation::query()->create([
        'product_id' => $product->id,
        'sku' => 'TEE-RED-M',
        'name' => 'Red / Medium',
        'price' => 19.99,
        'is_default' => true,
    ]);

    StoreVariationStock::query()->create([
        'store_id' => $store->id,
        'product_variation_id' => $variation->id,
        'stock' => 12,
        'is_active' => true,
    ]);

    $this->get(route('admin.seller.stores.show', [
        'seller' => $seller,
        'store' => $store,
    ]))
        ->assertSuccessful()
        ->assertSee('Inventory Overview')
        ->assertSee('Classic Tee')
        ->assertSee('Red / Medium')
        ->assertSee('TEE-RED-M');
});

it('updates and removes store stock assignments', function () {
    $seller = Seller::query()->create([
        'type' => SellerType::Business,
        'name' => 'Flow Seller',
        'business_email' => 'flow@example.com',
        'phone' => '1234567892',
    ]);

    $store = Store::query()->create([
        'seller_id' => $seller->id,
        'name' => 'Outlet Store',
    ]);

    $product = Product::query()->create([
        'seller_id' => $seller->id,
        'name' => 'Everyday Hoodie',
    ]);

    $variation = ProductVariation::query()->create([
        'product_id' => $product->id,
        'sku' => 'HOOD-BLK-L',
        'name' => 'Black / Large',
        'price' => 49.99,
        'is_default' => true,
    ]);

    $stock = StoreVariationStock::query()->create([
        'store_id' => $store->id,
        'product_variation_id' => $variation->id,
        'stock' => 4,
        'is_active' => true,
    ]);

    $this->put(route('admin.seller.stores.stocks.update', [
        'seller' => $seller,
        'store' => $store,
        'variationStock' => $stock,
    ]), [
        'stock' => 9,
        'is_active' => '0',
    ])->assertRedirect(route('admin.seller.stores.show', [
        'seller' => $seller,
        'store' => $store,
    ]));

    $this->assertDatabaseHas('store_variation_stocks', [
        'id' => $stock->id,
        'stock' => 9,
        'is_active' => false,
    ]);

    $this->delete(route('admin.seller.stores.stocks.destroy', [
        'seller' => $seller,
        'store' => $store,
        'variationStock' => $stock,
    ]))->assertRedirect(route('admin.seller.stores.show', [
        'seller' => $seller,
        'store' => $store,
    ]));

    $this->assertDatabaseMissing('store_variation_stocks', [
        'id' => $stock->id,
    ]);
});
