<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        return view('products.index', [
            'products' => Product::all()
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    public function buy(Product $product)
    {
        return back()->with('status', 'Приобретено!');
    }

    public function opinion(Product $product)
    {
        return view('products.opinion', [
            'product' => $product
        ]);
    }

    public function review(Product $product)
    {
        return view('products.review', [
            'product' => $product
        ]);
    }
}
