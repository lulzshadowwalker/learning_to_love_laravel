<main class="py-12 max-w-screen-lg mx-auto" x-data="{
    image: '{{ $this->product->image->path }}'
}">
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2">
            <img x-bind:src="image" alt="{{ $this->product->name }}" class="w-full">
        </div>
        <div class="w-full md:w-1/2 px-8 max-w-screen-sm max-md:mt-12">
            <h1 class="text-2xl font-bold dark:text-white">{{ $this->product->name }}</h1>
            <p class="text-gray-500">{{ $this->product->description }}</p>
            <div class="mt-4">
                <h2 class="text-lg font-semibold dark:text-white">Variants:</h2>
                <select wire:model="variant" class="w-full bg-transparent">
                    @foreach ($this->product->variants as $variant)
                        <option value="{{ $variant->id }}"">{{ $variant->size }} - {{ $variant->color }}</option>
                    @endforeach
                </select>

                @error('variant')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <x-button class="mt-4 py-4" wire:click="addToCart">Add to Cart</x-button>
        </div>
    </div>
    <div class="mt-8">
        <h2 class="text-lg font-semibold dark:text-gray-400">Other Images:</h2>
        <div class="grid grid-cols-4 gap-4 mt-4">
            @foreach ($this->product->images as $image)
                <img src="{{ $image->path }}" alt="{{ $this->product->name }}"
                    class="w-full aspect-square object-cover" @click="image = '{{ $image->path }}'">
            @endforeach
        </div>
    </div>
    </div>
</main>
