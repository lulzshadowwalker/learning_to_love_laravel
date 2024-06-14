@component('mail::message')
# Order Confirmation

Thank you for your order, {{ auth()->user()->name }}! Here are the details:

@component('mail::table')
| Item              | Price  | Qty | Total | Tax |
|:----------------- |------: |----: |-----: |---: |
@foreach ($order->items as $item)
| **{{ $item->name }}** | {{ $item->price }} | {{ $item->quantity }} | {{ $item->amount_total }} | {{ $item->amount_tax }} |
@endforeach
@endcomponent

@component('mail::table')
| Subtotal          | Shipping          | Discount | Tax     | Total        |
|:----------------- |:----------------- |:-------- |:------- |:------------ |
| {{ $order->amount_subtotal }} | {{ $order->amount_shipping }} | {{ $order->amount_discount }} | {{ $order->amount_tax }} | {{ $order->amount_total }} |
@endcomponent

@component('mail::button', ['url' => route('orders.show', $order->id), 'color' => 'success'])
View Order
@endcomponent

If you have any questions or concerns, please feel free to contact us.

Thanks, Aboba.
@endcomponent
