<div class="bg-white rounded-lg shadow-lg overflow-hidden product-card cursor-pointer {{ $class }}">
    <div class="h-40 bg-gray-200 flex items-center justify-center">
        @if($category->image)
            @php
                $imageUrl = (str_starts_with($category->image, 'http://') || str_starts_with($category->image, 'https://'))
                    ? $category->image
                    : asset('storage/' . $category->image);
            @endphp
            <img src="{{ $imageUrl }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
        @else
            <div class="h-16 w-16 rounded-md bg-gray-200 flex items-center justify-center text-gray-400 text-2xl">📁</div>
        @endif
    </div>
    <div class="p-4">
        <h4 class="text-lg font-bold mb-2 text-gray-900">{{ $category->name }}</h4>
        <p class="text-gray-600 mb-3 text-sm line-clamp-2">{{ $category->description }}</p>
        <a href="{{ route('categories.show', $category->id) }}"
        class="text-primary-600 font-semibold hover:text-primary-700 transition text-sm">
        Ver Productos →
        </a>
    </div>
</div>