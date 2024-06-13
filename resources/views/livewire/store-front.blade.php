<main class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-w-screen-lg mx-auto py-12">
    @foreach ($this->products as $product)
        <a href="{{ route('product.show', $product) }}"
            class="bg-white dark:bg-gray-800 rounded-sm shadow-sm p-4 transition-all hover:shadow-none">
            <img src="{{ $product->image->path }}" alt="{{ $product->name }}" class="w-full h-32 object-cover mb-4">
            <h2 class="text-lg font-semibold dark:text-white">{{ $product->name }}</h2>
            <p class="text-gray-500p dark:text-gray-400 line-clamp-2">{{ $product->description }}</p>
            <p class="text-gray-700 dark:text-gray-300 font-bold">{{ $product->price }}</p>
            <x-button class="mt-6">View <i class="fa-solid fa-eye inline-block ms-1"></i></x-button>
        </a>
    @endforeach
</main>
