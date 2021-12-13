<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

class ReportController extends Controller
{
    public function users()
    {
        return view('reports.users.index', [
            'users' => User::all()
        ]);
    }

    public function products()
    {
        return view('reports.products.index', [
            'products' => Product::all()
        ]);
    }

    public function showUser(User $user)
    {
        return view('reports.users.show', [
            'user' => $user
        ]);
    }

    public function showProduct(Product $product)
    {
        return view('reports.products.show', [
            'product' => $product
        ]);
    }
}
