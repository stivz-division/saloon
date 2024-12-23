<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum YooKassaPaymentType: string
{

    case ClientAdvertisement = 'client_advertisement';
    case MasterClientAdvertisement = 'master_client_advertisement';
    case MasterSubscription = 'master_subscription';
    case MasterSubscriptionAdvertisement = 'master_subscription_advertisement';
    case MasterTopAdvertisement = 'master_top_advertisement';

}