<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class GenerateProductReviewController extends Controller
{
    public function __invoke(Request $request)
    {
        // recibir el producto que se va a reseñar
        dd($request->all());
        $product = Product::findOrFail($request->product_id);

    }
}
