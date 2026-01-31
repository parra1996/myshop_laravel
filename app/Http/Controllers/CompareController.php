<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CompareController extends Controller
{
    /**
     * Muestra la página de comparación.
     */
    public function index(Request $request): View
    {
        $product1Id = $request->get('product1');
        $product2Id = $request->get('product2');

        $product1 = null;
        $product2 = null;

        if ($product1Id) {
            $product1 = Product::with(['category', 'offer'])->find($product1Id);
        }

        if ($product2Id) {
            $product2 = Product::with(['category', 'offer'])->find($product2Id);
        }

        // Obtener productos para el select 1 (excluyendo el producto 2 si está seleccionado)
        $products1 = Product::with(['category', 'offer'])
            ->when($product2Id, fn($q) => $q->where('id', '!=', $product2Id))
            ->orderBy('name')
            ->get();

        // Obtener productos para el select 2 (excluyendo el producto 1 si está seleccionado)
        $products2 = Product::with(['category', 'offer'])
            ->when($product1Id, fn($q) => $q->where('id', '!=', $product1Id))
            ->orderBy('name')
            ->get();

        return view('products.compare', compact('product1', 'product2', 'products1', 'products2'));
    }
}

