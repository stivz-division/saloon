<?php

namespace App\Http\Controllers;

use App\Domain\Enum\YooKassaPaymentType;
use App\Http\Requests\YookassaRequest;
use App\YooKassa\PaymentClientAdvertisement;
use YooKassa\Model\Notification\NotificationEventType;
use YooKassa\Model\Notification\NotificationSucceeded;

class YookassaController extends Controller
{

    public function index(YookassaRequest $request)
    {
        $requestBody = $request->all();

        if ($requestBody['event']
            !== NotificationEventType::PAYMENT_SUCCEEDED
        ) {
            return;
        }

        $notification = new NotificationSucceeded($requestBody);

        if ($notification->object->metadata->type
            === YooKassaPaymentType::ClientAdvertisement->value
        ) {
            (new PaymentClientAdvertisement($notification->object))
                ->execute();
        }
    }

}
