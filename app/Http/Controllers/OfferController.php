<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OfferController extends Controller
{
    public function index(): View
    {
        $offers = Offer::all();

        return view('offers.index', ['offers' => $offers]);
    }

    public function show(string $id): View
    {
        if (!is_numeric($id) || $id < 1) {
            abort(404, 'ID de oferta inválido');
        }

        $offer = Offer::find($id);

        if (!$offer) {
            abort(404, 'Oferta no encontrada');
        }

        $offerProducts = $offer->products()->with(['category'])->get();

        return view('offers.show', compact('offer', 'offerProducts'));
    }

    public function adminIndex(): View
    {
        $offers = Offer::withCount('products')->latest()->get();

        return view('admin.offers.index', compact('offers'));
    }

    public function create(): View
    {
        return view('admin.offers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:offers,name',
            'discount_percentage' => 'required|integer|min:1|max:100',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'active' => 'boolean',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'Ya existe una oferta con ese nombre.',
            'discount_percentage.required' => 'El descuento es obligatorio (1-100).',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['active'] = $request->boolean('active');

        Offer::create($validated);

        return redirect()->route('admin.offers.index')->with('success', 'Oferta creada correctamente.');
    }

    public function edit(Offer $offer): View
    {
        return view('admin.offers.edit', compact('offer'));
    }

    public function update(Request $request, Offer $offer): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:offers,name,' . $offer->id,
            'discount_percentage' => 'required|integer|min:1|max:100',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'active' => 'boolean',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'Ya existe una oferta con ese nombre.',
            'discount_percentage.required' => 'El descuento es obligatorio (1-100).',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['active'] = $request->boolean('active');

        $offer->update($validated);

        return redirect()->route('admin.offers.index')->with('success', 'Oferta actualizada correctamente.');
    }

    public function destroy(Offer $offer): RedirectResponse
    {
        $offer->products()->update(['offer_id' => null]);
        $offer->delete();

        return redirect()->route('admin.offers.index')->with('success', 'Oferta eliminada correctamente.');
    }
}