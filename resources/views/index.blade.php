<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Icommerce</title>
</head>

<body>
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold text-center py-1.5">Icommerce Basico Con IA</h1>
        <div class="flex flex-col items-center justify-center">
            <h2>Grid de Productos</h2>
            
            <div class="grid grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ $product->featured_image }}" alt="{{ $product->name }}" class="w-full">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">
                                {{ $product->name }}
                                <span class="inline-block bg-gray-200 text-xs font-semibold px-2 py-1 rounded-full">
                                    {{ $product->category->name }}
                                </span>
                            </h3>
                            <p class="text-gray-700 text-base">{{ $product->description }}</p>
                            <div class="flex items-center justify-between">
                                <p class="text-gray-700 text-sm">
                                    <span>Price:</span>
                                    <span class="font-bold">${{ $product->price }}</span>
                                </p>
                                <p class="text-gray-700 text-sm">
                                    <span>Rating:</span>
                                    <span class="font-bold">{{ $product->rating }}</span>
                                </p>
                            </div>

                            <form method="POST" action="/product-review">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <!-- Botón de review inteligente con emoji de I.A. -->
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    <span class="text-sm">¿Qué opina la IA?</span>
                                    <span class="text-xl">&#128526;</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Modal para mostrar la reseña de la IA -->
        <x-review-modal />

</body>

</html>
