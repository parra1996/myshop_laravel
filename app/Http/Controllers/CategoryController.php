<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        return view('categories.index', ['categories' => $categories]);
    }

    public function show(string $id): View
    {
        if (!is_numeric($id) || $id < 1) {
            abort(404, 'ID de categoría inválido');
        }

        $category = Category::find($id);

        if (!$category) {
            abort(404, 'Categoría no encontrada');
        }

        $categoryProducts = $category->products()->with(['offer'])->get();

        return view('categories.show', compact('category', 'categoryProducts'));
    }

    public function adminIndex(): View
    {
        $categories = Category::withCount('products')->latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('', 'public');
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('', 'public');
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->exists()) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'No se puede eliminar: tiene productos asociados.');
        }
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Categoría eliminada correctamente.');
    }
}