<?php

namespace App\Http\Controllers;

use App\Dtos\Home\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
         $popular_products = [
            new Product(
                id: 1,
                name: 'Essence Mascara Lash Princess',
                price: '9.99',
                rating: '2.56',
                image: 'https://cdn.dummyjson.com/product-images/beauty/essence-mascara-lash-princess/thumbnail.webp',
            ),
            new Product(
                id: 2,
                name: 'Eyeshadow Palette with Mirror',
                price: '19.99',
                rating: '2.86',
                image: 'https://cdn.dummyjson.com/product-images/beauty/eyeshadow-palette-with-mirror/thumbnail.webp',
            ),
            new Product(
                id: 3,
                name: 'Powder Canister',
                price: '14.99',
                rating: '4.64',
                image: 'https://cdn.dummyjson.com/product-images/beauty/powder-canister/thumbnail.webp',
            ),
             new Product(
                id: 4,
                name: 'Red Lipstick',
                price: '12.99',
                rating: '4.36',
                image: 'https://cdn.dummyjson.com/product-images/beauty/red-lipstick/thumbnail.webp',
            ),
        ];

        $related_products = [
             new Product(
                id: 1,
                name: 'iPhone 5s',
                price: '199.99',
                rating: '2.83',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/iphone-5s/thumbnail.webp',
            ),
             new Product(
                id: 2,
                name: 'iPhone 6',
                price: '299.99',
                rating: '3.41',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/iphone-6/thumbnail.webp',
            ),
             new Product(
                id: 3,
                name: 'iPhone 13 Pro',
                price: '1099.99',
                rating: '4.12',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/iphone-13-pro/thumbnail.webp',
            ),
             new Product(
                id: 4,
                name: 'iPhone X',
                price: '899.99',
                rating: '2.51',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/iphone-x/thumbnail.webp',
            ),
             new Product(
                id: 5,
                name: 'Oppo A57',
                price: '249.99',
                rating: '3.94',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/oppo-a57/thumbnail.webp',
            ),
             new Product(
                id: 6,
                name: 'Oppo F19 Pro Plus',
                price: '399.99',
                rating: '3.51',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/oppo-f19-pro-plus/thumbnail.webp',
            ),
             new Product(
                id: 7,
                name: 'Oppo K1',
                price: '299.99',
                rating: '4.25',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/oppo-k1/thumbnail.webp',
            ),
             new Product(
                id: 8,
                name: 'Realme C35',
                price: '149.99',
                rating: '4.2',
                image: 'https://cdn.dummyjson.com/product-images/smartphones/realme-c35/thumbnail.webp',
            ),
        ];

        $recent_products = [
             new Product(
                id: 1,
                name: 'Annibale Colombo Bed',
                price: '1899.99',
                rating: '4.77',
                image: 'https://cdn.dummyjson.com/product-images/furniture/annibale-colombo-bed/thumbnail.webp',
            ),
            new Product(
                id: 2,
                name: 'Annibale Colombo Sofa',
                price: '2499.99',
                rating: '3.92',
                image: 'https://cdn.dummyjson.com/product-images/furniture/annibale-colombo-sofa/thumbnail.webp',
            ),
             new Product(
                id: 3,
                name: 'Bedside Table African Cherry',
                price: '299.99',
                rating: '2.87',
                image: 'https://cdn.dummyjson.com/product-images/furniture/bedside-table-african-cherry/thumbnail.webp',
            ),
             new Product(
                id: 4,
                name: 'Knoll Saarinen Executive Conference Chair',
                price: '499.99',
                rating: '4.88',
                image: 'https://cdn.dummyjson.com/product-images/furniture/knoll-saarinen-executive-conference-chair/thumbnail.webp',
            ),
        ];

        return view('app.index', [
            'popular_products' => $popular_products,
            'related_products' => $related_products,
            'recent_products' => $recent_products,
        ]);
    }
}
