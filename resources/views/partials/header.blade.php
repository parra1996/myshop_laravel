<!-- Carrito de Compras -->
<header class="bg-white shadow-lg relative">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold text-primary-600">
                    🛍️ Parrita's VideoStore
                </a>
            </div>
            
        <!-- Navegación usando partial -->
        @include('partials.navigation')
            
            <!-- Carrito -->
            @php
                $cart = session('cart', []);
                $totalQuantity = array_sum(array_column($cart, 'quantity'));
            @endphp
            <div class="flex items-center space-x-4">
            <a href="{{ route('cart.index') }}" 
                class="text-gray-700 hover:text-primary-600 transition">
                    🛒 Carrito ( {{ $totalQuantity }} )
            </a>
            </div>
        </div>
    </div>
</header>