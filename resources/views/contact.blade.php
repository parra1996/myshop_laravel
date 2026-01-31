@extends('layouts.public')
@section('title', 'Contacto - Parrita\'s VideoStore')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Contacta con Nosotros</h1>
                <p class="text-gray-600">Estamos aquí para ayudarte. Elige la forma que prefieras.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <span class="text-3xl">📞</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Teléfono</h3>
                    </div>
                    <p class="text-gray-600 mb-2">Llámanos directamente</p>
                    <p class="text-primary-600 font-semibold text-lg">634 472 548</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 rounded-full p-3 mr-4">
                            <span class="text-3xl">📧</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Email</h3>
                    </div>
                    <p class="text-gray-600 mb-2">Escríbenos un correo</p>
                    <a href="mailto:juaparlab@alu.edu.gva.es" class="text-primary-600 font-semibold text-lg hover:text-primary-700 transition break-all">
                        juaparlab@alu.edu.gva.es
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <div class="bg-purple-100 rounded-full p-3 mr-4">
                            <span class="text-3xl">💬</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Chat en Vivo</h3>
                    </div>
                    <p class="text-gray-600 mb-2">Conversa con nosotros</p>
                    <p class="text-primary-600 font-semibold text-lg">Disponible pronto</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <div class="bg-orange-100 rounded-full p-3 mr-4">
                            <span class="text-3xl">🕒</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Horario</h3>
                    </div>
                    <p class="text-gray-600 mb-2">Nuestro horario de atención</p>
                    <p class="text-primary-600 font-semibold text-lg">10:00 - 18:00</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Síguenos en Redes Sociales</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="https://x.com/juan_parra17" target="_blank" class="flex items-center justify-center bg-blue-500 text-white px-6 py-4 rounded-lg hover:bg-blue-600 transition">
                        <span class="text-2xl mr-3">🐦</span>
                        <span class="font-semibold">X: @parritavideostore</span>
                    </a>
                    <a href="#" target="_blank" class="flex items-center justify-center bg-blue-700 text-white px-6 py-4 rounded-lg hover:bg-blue-800 transition">
                        <span class="text-2xl mr-3">📘</span>
                        <span class="font-semibold">Facebook: @parritavideostore</span>
                    </a>
                    <a href="https://www.instagram.com/juanparra17/" target="_blank" class="flex items-center justify-center bg-pink-500 text-white px-6 py-4 rounded-lg hover:bg-pink-600 transition">
                        <span class="text-2xl mr-3">📷</span>
                        <span class="font-semibold">Instagram: @parritavideostore</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
