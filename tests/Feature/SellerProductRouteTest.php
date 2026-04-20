<?php

use App\Enums\ProductMediaType;
use App\Enums\SellerType;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

it('shows the media management section on the product page', function () {
    $seller = Seller::query()->create([
        'type' => SellerType::Business,
        'name' => 'Media Seller',
        'business_email' => 'media-seller@example.com',
        'phone' => '1234567891',
    ]);

    $product = Product::query()->create([
        'seller_id' => $seller->id,
        'name' => 'Camera Pro',
        'description' => 'Mirrorless camera body.',
    ]);

    ProductMedia::query()->create([
        'product_id' => $product->id,
        'file_path' => 'products/images/camera-front.jpg',
        'type' => ProductMediaType::IMAGE->value,
        'is_primary' => true,
    ]);

    $this->get(route('admin.seller.products.show', [
        'seller' => $seller,
        'product' => $product,
    ]))
        ->assertSuccessful()
        ->assertSee('Product Media')
        ->assertSee('Manage Media');
});

it('creates updates and deletes product media as a nested resource', function () {
    Storage::fake('s3');

    $seller = Seller::query()->create([
        'type' => SellerType::Business,
        'name' => 'Studio Seller',
        'business_email' => 'studio-seller@example.com',
        'phone' => '1234567892',
    ]);

    $product = Product::query()->create([
        'seller_id' => $seller->id,
        'name' => 'Studio Light',
        'description' => 'Continuous light kit.',
    ]);

    $image = UploadedFile::fake()->image('light.jpg');

    $this->post(route('admin.seller.product.medias.store', [
        'seller' => $seller,
        'product' => $product,
    ]), [
        'file' => $image,
        'type' => ProductMediaType::IMAGE->value,
        'is_primary' => '1',
    ])
        ->assertRedirect(route('admin.seller.products.show', [
            'seller' => $seller,
            'product' => $product,
        ]));

    $media = ProductMedia::query()->firstOrFail();

    expect($media->product_id)->toBe($product->id)
        ->and($media->is_primary)->toBeTrue();

    $replacement = UploadedFile::fake()->image('light-updated.jpg');

    $this->put(route('admin.seller.product.medias.update', [
        'seller' => $seller,
        'product' => $product,
        'media' => $media,
    ]), [
        'file' => $replacement,
        'type' => ProductMediaType::THUMBNAIL->value,
        'is_primary' => '0',
    ])
        ->assertRedirect(route('admin.seller.products.show', [
            'seller' => $seller,
            'product' => $product,
        ]));

    $media->refresh();

    expect($media->type)->toBe(ProductMediaType::THUMBNAIL->value)
        ->and($media->is_primary)->toBeFalse();

    $this->delete(route('admin.seller.product.medias.destroy', [
        'seller' => $seller,
        'product' => $product,
        'media' => $media,
    ]))
        ->assertRedirect(route('admin.seller.products.show', [
            'seller' => $seller,
            'product' => $product,
        ]));

    $this->assertDatabaseMissing('product_media', [
        'id' => $media->id,
    ]);
});
