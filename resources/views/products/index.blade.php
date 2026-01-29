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