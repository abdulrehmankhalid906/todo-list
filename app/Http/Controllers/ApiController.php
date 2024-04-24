<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getProductApi()
    {
        $products = Http::get('https://dummyjson.com/products');

        return view('api.product', [
            'products' => $products['products']
        ]);
    }
}
