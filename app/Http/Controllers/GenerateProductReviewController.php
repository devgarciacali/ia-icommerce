<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Prism\Prism\Prism;
use Prism\Prism\Enums\Provider;

class GenerateProductReviewController extends Controller
{
    public function __invoke(Request $request)
    {
        // recibir el producto que se va a reseñar
        $product = Product::findOrFail($request->product_id);

        // escribir el promp que se enviará a la API de groq
        $prompt = <<<EOT
            Eres un analista experto en e-commerce. Basado a estos datos  genera una reseña persuasiva:
            - Producto: {$product->name}
            - Categoría: {$product->category->name}
            - Precio: {$product->price} USD
            - Calificación promedio: {$product->rating} / 5
            - Total de ventas: {$product->quantity_sold}
            - Stock restante: {$product->stock}

            Si el stock es bajo, genera sencion de urgencia para comprar el producto, se honesto, util y atractivo para el comprador. 
            EOT;


        // se instacia prism y se genera la reseña
        $prism = new Prism();

        $review = $prism->text()
            ->using(Provider::Groq, 'llama-3.1-8b-instant')
            ->withPrompt($prompt)
            ->asText();

       return response()->json(['review' => $review->text]);
    }
}
