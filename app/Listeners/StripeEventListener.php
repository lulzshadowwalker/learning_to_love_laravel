<?php

namespace App\Listeners;

use App\Actions\Webshop\HandleStripeCheckoutCompleted;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'checkout.session.completed') {
            (new HandleStripeCheckoutCompleted)->handle($event->payload['data']['object']['id']);
        }
    }
}
