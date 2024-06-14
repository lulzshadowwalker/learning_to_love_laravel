<main class="flex flex-col items-center justify-center mt-36">
    @if ($this->order)
        <section class="flex flex-col items-center">
            <div class="flex gap-4">
                <i class="fa-solid fa-circle-check h-16 mb-8"></i>
                <div>
                    <h2 class="text-4xl font-semibold mb-4">Purchase Successful</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400">Thank you for your purchase!</p>
                </div>
            </div>

            <div class="flex items-center justify-center gap-2 mt-8">
                <x-button>
                    <a href="{{ route('orders.show', $this->order) }}">View Order</a>
                </x-button>

                <x-button>
                    <a href="{{ route('home') }}">Take Me Home</a>
                </x-button>
            </div>
        </section>
    @else
        <section wire:poll class="flex flex-col items-center">
            <i class="fa-solid fa-spinner h-16 mb-8 animate-spin duration-[2600ms]"></i>
            <h2 class="text-3xl font-bold mb-4">Payment Confirmation Pending</h2>
            <p class="text-gray-600">Please wait a little while we confirm your payment.</p>
        </section>
    @endif
</main>
