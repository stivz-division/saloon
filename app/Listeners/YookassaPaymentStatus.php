<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Nos\Yookassa\Events\YookassaPaymentNotification;
use YooKassa\Model\Payment\PaymentStatus;

class YookassaPaymentStatus
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(YookassaPaymentNotification $event): void
    {
        if ($event->payment->status === PaymentStatus::SUCCEEDED->value) {
            Log::log('PAYMENT', [
                'data' => $event->payment->metadata,
            ]);
        }
    }

}
