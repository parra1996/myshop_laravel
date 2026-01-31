@extends('layouts.public')
@section('title', 'Todos los Productos - Parrita\'s VideoStore')
@push('styles')
<style>
.product-grid {
display: grid;
grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
gap: 2rem;
}
</style>
@endpush
@section('content')
<div class="container mx-auto px-6 py-8">
@if ($_SERVER['REQUEST_URI'] == '/products-on-sale')
<div class="mb-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg shadow-lg p-8 black">
<h1 class="text-3xl font-bold mb-4">¡Productos en Oferta!</h1>
<h4 class="text-xl font-bold whitemb-4  text-white">{{sizeof($products)}} productos en oferta</h4>
</div>
@else
<h1 class="text-3xl font-bold text-gray-900 mb-4">Todos los Productos</h1>
<div class="flex  flex-row gap-2 mb-4">
<form method="GET" action="{{ route('products.index') }}" class="flex flex-row gap-2 mb-4">
    <input type="text" 
           name="search" 
           id="search" 
           placeholder="Buscar producto" 
           class="border-2 border-gray-300 rounded-md p-2 w-full"
           value="{{ request('search') }}">  <!-- Mantener el valor después de buscar -->
    <button type="submit" class="bg-blue-500 text-white rounded-md p-2">
        Buscar
    </button>
    @if(request('search'))
        <a href="{{ route('products.index') }}" class="bg-gray-500 text-white rounded-md p-2">
            Limpiar
        </a>
    @endif
</form>
</div>
@endif
<div class="product-grid">
@forelse($products as $product)
<x-product-card :product="$product" />
@empty
<div class="col-span-full text-center py-12">
<p class="text-gray-500 text-lg">No hay productos disponibles.
</p>
</div>
@endforelse
</div>
</div>
@endsection