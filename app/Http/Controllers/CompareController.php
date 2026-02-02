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

        $products = Product::with(['category', 'offer'])
            ->orderBy('name')
            ->get();

        return view('products.compare', compact('product1', 'product2', 'products'));
    }

    public function index_post(Request $request):View 
    {
        $product1Id = $request->post('product1');
        $product2Id = $request->post('product2');

        $product1 = null;
        $product2 = null;

        if ($product1Id) {
            $product1 = Product::with(['category', 'offer'])->find($product1Id);
        }

        if ($product2Id) {
            $product2 = Product::with(['category', 'offer'])->find($product2Id);
        }

        $products = Product::with(['category', 'offer'])
            ->orderBy('name')
            ->get();

        return view('products.compare', compact('product1', 'product2', 'products'));
    }
}