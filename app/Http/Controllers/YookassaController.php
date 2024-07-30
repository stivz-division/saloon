<?php

namespace App\Http\Controllers;

use App\Domain\Enum\YooKassaPaymentType;
use App\Http\Requests\YookassaRequest;
use App\YooKassa\MasterPaymentClientAdvertisement;
use App\YooKassa\MasterPaymentSubscribe;
use App\YooKassa\MasterSubscriptionAdvertisement;
use App\YooKassa\MasterTopAdvertisement;
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

        if ($notification->object->metadata->type
            === YooKassaPaymentType::MasterClientAdvertisement->value
        ) {
            (new MasterPaymentClientAdvertisement($notification->object))
                ->execute();
        }

        if ($notification->object->metadata->type
            === YooKassaPaymentType::MasterSubscriptionAdvertisement->value
        ) {
            (new MasterSubscriptionAdvertisement($notification->object))
                ->execute();
        }

        if ($notification->object->metadata->type
            === YooKassaPaymentType::MasterSubscription->value
        ) {
            (new MasterPaymentSubscribe($notification->object))
                ->execute();
        }

        if ($notification->object->metadata->type
            === YooKassaPaymentType::MasterTopAdvertisement->value
        ) {
            (new MasterTopAdvertisement($notification->object))
                ->execute();
        }
    }

}
