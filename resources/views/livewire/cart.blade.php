<main class="max-w-screen-lg mx-auto py-12">
    <h1 class="text-4xl font-semibold mb-8 pb-8 border-b-[0.5px] border-gray-400">Shopping Cart</h1>
    @if (count($this->cart->items) > 0)
        @foreach ($this->cart->items as $item)
            <section class="flex items-stretch mb-4">
                <img src="{{ $item->product->image->path }}" alt="{{ $item->product->name }}"
                    class="w-32 mr-4 object-cover">
                <div class="flex flex-col items-start">
                    <h2 class="text-lg font-bold">{{ $item->product->name }}</h2>
                    <p class="text-gray-500">{{ $item->product->description }}</p>
                    <p class="mt-2">Color: <span class="text-gray-500">{{ $item->variant->color }}</span></p>
                    <p>Size: <span class="text-gray-500">{{ $item->variant->size }}</span></p>

                    <div class="flex items-center gap-2 mt-auto">
                        <x-button class="!bg-red-400 transition-all hover:!bg-red-500"
                            wire:click="decrement({{ $item->id }})"><i class="fa-duotone fa-minus"></i>
                            @if ($item->quantity === 1)
                                <i class="fa-solid fa-trash"></i>
                            @else
                                <i class="fa-solid fa-minus"></i>
                            @endif
                        </x-button>

                        <span class="mx-2">{{ $item->quantity }}</span>

                        <x-button class="!bg-green-400 transition-all hover:!bg-green-500 mt-auto"
                            wire:click="increment({{ $item->id }})"><i class="fa-duotone fa-plus"></i>
                            <i class="fa-solid fa-plus"></i></x-button>
                    </div>
                </div>
            </section>
        @endforeach

        <div class="flex justify-between items-center mt-8">
            <div>
                <p class="text-lg font-semibold">Total: {{ $this->cart->total }}</p>
            </div>
            <div>
                <x-button class="!bg-red-400 transition-all hover:!bg-red-500" wire:click="clear">Clear
                    Cart</x-button>

                @auth
                    <x-button class="!bg-green-400 transition-all hover:!bg-green-500 flex items-center gap-1"
                        wire:click="checkout">
                        Checkout
                    </x-button>
                @endauth()
                @guest()
                    <a href="/login?to=cart">
                        <x-button class="!bg-green-400 transition-all hover:!bg-green-500">Login To
                            Continue</x-button>
                    </a>
                @endguest
            </div>
        @else
            <p>Your cart is empty.</p>
    @endif
</main>
