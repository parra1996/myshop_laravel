@extends('layouts.public')
@section('title', 'Comparar Productos - Mi Tienda')
@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Comparar Productos</h1>
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Selecciona 2 productos para comparar</h2>
        <form method="GET" action="{{ route('compare') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Producto 1</label>
                <select name="product1" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Selecciona un producto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product1 && $product1->id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} - €{{ number_format($product->final_price ?? $product->price, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Producto 2</label>
                <select name="product2" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">Selecciona un producto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product2 && $product2->id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} - €{{ number_format($product->final_price ?? $product->price, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                    Comparar
                </button>
            </div>
        </form>
    </div>

    @if($product1 && $product2)
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Comparación</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Producto 1 --}}
            <div class="border-2 border-blue-500 rounded-lg p-4">
                <h3 class="font-bold text-lg mb-3">{{ $product1->name }}</h3>
                <div class="mb-4">
                    @if($product1->image)
                        @php
                            $imageUrl = (str_starts_with($product1->image, 'http://') || str_starts_with($product1->image, 'https://'))
                                ? $product1->image
                                : asset('storage/' . $product1->image);
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $product1->name }}" class="w-full h-48 object-cover rounded">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded flex items-center justify-center">
                            <span class="text-4xl">📦</span>
                        </div>
                    @endif
                </div>
                <div class="space-y-2 text-sm">
                    <div><span class="font-semibold">Precio:</span> 
                        @if($product1->offer)
                            <span class="line-through text-gray-400">€{{ number_format($product1->price, 2) }}</span>
                            <span class="text-orange-600 font-bold">€{{ number_format($product1->final_price, 2) }}</span>
                        @else
                            <span class="text-primary-600 font-bold">€{{ number_format($product1->price, 2) }}</span>
                        @endif
                    </div>
                    <div><span class="font-semibold">Marca:</span> {{ $product1->brand }}</div>
                    <div><span class="font-semibold">Plataforma:</span> {{ $product1->platform }}</div>
                    <div><span class="font-semibold">Tipo:</span> {{ $product1->type === 'game' ? 'Juego' : 'Accesorio' }}</div>
                    <div><span class="font-semibold">Stock:</span> 
                        @if($product1->stock > 0)
                            <span class="text-green-600">{{ $product1->stock }} unidades</span>
                        @else
                            <span class="text-red-600">Agotado</span>
                        @endif
                    </div>
                    @if($product1->category)
                        <div><span class="font-semibold">Categoría:</span> {{ $product1->category->name }}</div>
                    @endif
                </div>
                <a href="{{ route('products.show', $product1->id) }}" 
                   class="mt-4 inline-block bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition text-sm">
                    Ver Detalles
                </a>
            </div>

            <div class="border-2 border-green-500 rounded-lg p-4">
                <h3 class="font-bold text-lg mb-3">{{ $product2->name }}</h3>
                <div class="mb-4">
                    @if($product2->image)
                        @php
                            $imageUrl = (str_starts_with($product2->image, 'http://') || str_starts_with($product2->image, 'https://'))
                                ? $product2->image
                                : asset('storage/' . $product2->image);
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $product2->name }}" class="w-full h-48 object-cover rounded">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded flex items-center justify-center">
                            <span class="text-4xl">📦</span>
                        </div>
                    @endif
                </div>
                <div class="space-y-2 text-sm">
                    <div><span class="font-semibold">Precio:</span> 
                        @if($product2->offer)
                            <span class="line-through text-gray-400">€{{ number_format($product2->price, 2) }}</span>
                            <span class="text-orange-600 font-bold">€{{ number_format($product2->final_price, 2) }}</span>
                        @else
                            <span class="text-primary-600 font-bold">€{{ number_format($product2->price, 2) }}</span>
                        @endif
                    </div>
                    <div><span class="font-semibold">Marca:</span> {{ $product2->brand }}</div>
                    <div><span class="font-semibold">Plataforma:</span> {{ $product2->platform }}</div>
                    <div><span class="font-semibold">Tipo:</span> {{ $product2->type === 'game' ? 'Juego' : 'Accesorio' }}</div>
                    <div><span class="font-semibold">Stock:</span> 
                        @if($product2->stock > 0)
                            <span class="text-green-600">{{ $product2->stock }} unidades</span>
                        @else
                            <span class="text-red-600">Agotado</span>
                        @endif
                    </div>
                    @if($product2->category)
                        <div><span class="font-semibold">Categoría:</span> {{ $product2->category->name }}</div>
                    @endif
                </div>
                <a href="{{ route('products.show', $product2->id) }}" 
                   class="mt-4 inline-block bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition text-sm">
                    Ver Detalles
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

