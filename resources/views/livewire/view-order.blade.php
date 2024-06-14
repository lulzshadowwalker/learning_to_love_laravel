<div class="mx-auto py-12 max-w-screen-lg">
    <div class="shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex items-center gap-6 mb-3">
            <a href="{{ route('orders.index') }}">
                <i class="fa-solid fa-arrow-left-long scale-150"></i>
            </a>
            <h2 class="text-3xl leading-6 font-medium">Order Details</h2>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700">
            <dl>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Order ID</dt>
                    <dd class="mt-1 text-sm sm:col-span-2">{{ $this->order->id }}</dd>
                </div>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Amount</dt>
                    <dd class="mt-1 text-smsm:col-span-">
                        {{ $this->order->amount_total }}</dd>
                </div>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Subtotal</dt>
                    <dd class="mt-1 text-smsm:col-span-2">
                        {{ $this->order->amount_subtotal }}</dd>
                </div>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tax</dt>
                    <dd class="mt-1 text-sm sm:col-span-2">{{ $this->order->amount_tax }}
                    </dd>
                </div>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Shipping</dt>
                    <dd class="mt-1 text-sm sm:col-span-2">
                        {{ $this->order->amount_shipping }}</dd>
                </div>
                @if ($this->order->amount_discount->isPositive())
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Discount</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            -{{ $this->order->amount_discount }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700">
            <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <h3 class="text-lg font-medium dark:text-white">Shipping Address</h3>
                <div class="mt-1 text-sm sm:col-span-2">
                    <p>{{ $this->order->shipping_address['line1'] }}</p>
                    <p>{{ $this->order->shipping_address['city'] }}, {{ $this->order->shipping_address['state'] }}
                        {{ $this->order->shipping_address['postal_code'] }}</p>
                    <p>{{ $this->order->shipping_address['country'] }}</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700">
            <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <h3 class="text-lg font-medium ">Billing Address</h3>
                <div class="mt-1 text-sm sm:col-span-2">
                    <p>{{ $this->order->billing_address['line1'] }}</p>
                    <p>{{ $this->order->billing_address['city'] }}, {{ $this->order->billing_address['state'] }}
                        {{ $this->order->billing_address['postal_code'] }}</p>
                    <p>{{ $this->order->billing_address['country'] }}</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium">Order Items</h3>
                <div class="mt-4 text-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-nowrap divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($this->order->items as $item)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $item->name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $item->description }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $item->price }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $item->quantity }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $item->amount_total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
