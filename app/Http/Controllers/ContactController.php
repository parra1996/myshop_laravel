<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Show the contact page
     */
    public function index(): View
    {
        return view('contact');
    }

    /**
     * Process the contact form submission.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email'],
            'motivo' => ['required', 'string', 'max:2000'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Introduce un email válido.',
            'motivo.required' => 'Indica el motivo del contacto.',
        ]);

        // Aquí podrías enviar un email, guardar en BD, etc.
        // Por ahora solo redirigimos con mensaje de éxito.
        return redirect()->route('contact')->with('success', 'Gracias por contactarnos, ' . $validated['nombre'] . '. Te responderemos lo antes posible.');
    }
}
