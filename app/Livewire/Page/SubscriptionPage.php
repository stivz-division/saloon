<?php

namespace App\Livewire\Page;

use App\Domain\Enum\YooKassaPaymentType;
use App\Repositories\SubscriptionRepository;
use Livewire\Attributes\Computed;
use Livewire\Component;
use YooKassa\Client;
use YooKassa\Model\CurrencyCode;

class SubscriptionPage extends Component
{

    #[Computed]
    public function subscriptions()
    {
        return app(SubscriptionRepository::class)->list();
    }

    public function subscribe($idSubscribe)
    {
        $subscription = $this->subscriptions()->where('id', $idSubscribe)
            ->first();

        if ($subscription === null) {
            return;
        }
        $client = app(Client::class);

        $idempotenceKey = uniqid('', true);

        $response = $client->createPayment(
            [
                'amount'       => [
                    'value'    => $subscription->price,
                    'currency' => CurrencyCode::RUB,
                ],
                'confirmation' => [
                    'type'       => 'redirect',
                    'locale'     => 'ru_RU',
                    'return_url' => route('welcome'),
                ],
                'capture'      => true,
                'description'  => 'Оплата мастером подписки объявления',
                'metadata'     => [
                    'type'            => YooKassaPaymentType::MasterSubscriptionAdvertisement->value,
                    'subscription_id' => $subscription->id,
                    'user_id'         => auth()->id(),
                ],
            ],
            $idempotenceKey
        );

        $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();

        $this->redirect($confirmationUrl);
    }

    public function render()
    {
        return view('livewire.page.subscription-page');
    }

}
