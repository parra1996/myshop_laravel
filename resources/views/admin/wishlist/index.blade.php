<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Lista de Deseos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($wishlistProducts->isEmpty())
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">💔</div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Tu lista de deseos está vacía</h3>
                            <p class="text-gray-600 mb-6">Explora nuestros productos y guarda tus favoritos</p>
                            <a href="{{ route('products.index') }}" class="inline-block bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition">
                                Explorar Productos
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($wishlistProducts as $product)
                                <x-product-card :product="$product" class="">
                                    {{-- Slot para botón de eliminar en esquina superior izquierda --}}
                                    <x-slot name="topAction">
                                        <form action="{{ route('admin.wishlist.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-2xl bg-blue-500 hover:scale-125 transition-transform text-white " title="Eliminar de favoritos">
                                                ❌
                                            </button>
                                        </form>
                                    </x-slot>

                                    {{-- Slot para acciones personalizadas en el footer --}}
                                    <x-slot name="actions">
                                        <div class="flex gap-2">
                                            <form action="{{ route('cart.store') }}" method="POST" class="flex-1">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}"> <!-- tuve que cambiar el texto a negro para que puedan leerse -->
                                                <button type="submit" class="w-full bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-700 transition text-white ">
                                                    🛒 Añadir al Carrito
                                                </button>
                                            </form>
                                            <a href="{{ route('products.show', $product->id) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                                                Ver
                                            </a>
                                        </div>
                                    </x-slot>
                                </x-product-card>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>