<a href="{{ route('cart') }}" class="inline-block relative">
    <i class="fa-solid fa-cart-shopping"></i>

    @if ($this->count > 0)
        <div
            class="w-[20px] h-[20px] bg-red-500 text-white text-xs rounded-full flex items-center justify-center absolute -top-[0.6rem] -end-[0.8rem]">
            {{ $this->count }}
        </div>
    @endif
</a>
