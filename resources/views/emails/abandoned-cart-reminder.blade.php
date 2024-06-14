@component('mail::message')
<h1>Abandoned Cart Reminder</h1>
Hey {{ auth()->user()->name }}, you have items in your cart!<br>
You can continue the checkout process by clicking the button below:

@component('mail::button', ['url' => route('cart')])
    {{ __('Continue Checkout') }}
@endcomponent

<center>
If you did not expect to receive this email, you may discard it.
</center>
@endcomponent
