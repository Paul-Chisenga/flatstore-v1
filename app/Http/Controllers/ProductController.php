<?php

namespace App\Http\Controllers;

use App\Dtos\Products\Product;
use App\Dtos\Home\Product as HomeProduct;
use Illuminate\View\View;

class ProductController extends Controller
{
    //
    public function index(): View
    {
        return view('app.products.index');
    }

    public function show($id): View
    {
        $product = new Product(
            id: 1,
            name: 'iPhone 5s',
            price: '199.99',
            rating: '2.83',
            image: 'https://cdn.dummyjson.com/product-images/smartphones/iphone-5s/thumbnail.webp',
            description: "The Annibale Colombo Bed is a luxurious and elegant piece of furniture that combines classic design with modern comfort. Crafted with high-quality materials, this bed features a sturdy frame and a plush headboard, providing both style and support for a restful night's sleep. The intricate detailing and timeless design make it a perfect addition to any bedroom decor, offering a touch of sophistication and charm."
        );

         $related_products = [
             new HomeProduct(
                id: 1,
                name: 'iPhone 5s',
                price: '199.99',
                rating: '2.83',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/iphone-5s/thumbnail.webp',
            ),
             new HomeProduct(
                id: 2,
                name: 'iPhone 6',
                price: '299.99',
                rating: '3.41',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/iphone-6/thumbnail.webp',
            ),
             new HomeProduct(
                id: 3,
                name: 'iPhone 13 Pro',
                price: '1099.99',
                rating: '4.12',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/iphone-13-pro/thumbnail.webp',
            ),
             new HomeProduct(
                id: 4,
                name: 'iPhone X',
                price: '899.99',
                rating: '2.51',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/iphone-x/thumbnail.webp',
            ),
             new HomeProduct(
                id: 5,
                name: 'Oppo A57',
                price: '249.99',
                rating: '3.94',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/oppo-a57/thumbnail.webp',
            ),
             new HomeProduct(
                id: 6,
                name: 'Oppo F19 Pro Plus',
                price: '399.99',
                rating: '3.51',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/oppo-f19-pro-plus/thumbnail.webp',
            ),
             new HomeProduct(
                id: 7,
                name: 'Oppo K1',
                price: '299.99',
                rating: '4.25',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/oppo-k1/thumbnail.webp',
            ),
             new HomeProduct(
                id: 8,
                name: 'Realme C35',
                price: '149.99',
                rating: '4.2',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/realme-c35/thumbnail.webp',
            ),
        ];

        return view('app.products.show', ['product' => $product, "related_products" => $related_products]);
    }
}
