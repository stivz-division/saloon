<?php

namespace App\Livewire\Page\MasterPayment;

use App\Domain\Enum\YooKassaPaymentType;
use Livewire\Component;
use YooKassa\Client;
use YooKassa\Model\CurrencyCode;

class SubscriptionPage extends Component
{

    public function mount()
    {
        $user = auth()->user();

        if ($user->isActiveSubscription()) {
            session()->flash('success', 'У вас уже есть подписка');

            $this->redirectRoute('welcome');
        }
    }

    public function paymentAdvertisement()
    {
        $client = app(Client::class);

        $idempotenceKey = uniqid('', true);

        $response = $client->createPayment(
            [
                'amount'       => [
                    'value'    => config('yookassa.master-subscription'),
                    'currency' => CurrencyCode::RUB,
                ],
                'confirmation' => [
                    'type'       => 'redirect',
                    'locale'     => 'ru_RU',
                    'return_url' => route('welcome'),
                ],
                'capture'      => true,
                'description'  => 'Оплата мастером подписки',
                'metadata'     => [
                    'type'      => YooKassaPaymentType::MasterSubscription->value,
                    'master_id' => auth()->id(),
                ],
            ],
            $idempotenceKey
        );

        $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();

        $this->redirect($confirmationUrl);
    }

    public function render()
    {
        return view('livewire.page.master-payment.subscription-page');
    }

}
