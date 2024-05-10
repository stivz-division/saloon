<?php

namespace App\Livewire\Page\Advertisement\Client;

use App\Domain\Enum\YooKassaPaymentType;
use Livewire\Component;
use YooKassa\Client;
use YooKassa\Model\CurrencyCode;

class Payment extends Component
{

    /** @var \App\Models\ClientAdvertisement */
    public $advertisement;

    public function render()
    {
        return view('livewire.page.advertisement.client.payment');
    }

    public function paymentAdvertisement()
    {
        $client = app(Client::class);

        $idempotenceKey = uniqid('', true);

        $response = $client->createPayment(
            [
                'amount'       => [
                    'value'    => config('yookassa.client-advertisement'),
                    'currency' => CurrencyCode::RUB,
                ],
                'confirmation' => [
                    'type'       => 'redirect',
                    'locale'     => 'ru_RU',
                    'return_url' => route('client.advertisement.show', [
                        'advertisement' => $this->advertisement->uuid,
                    ]),
                ],
                'capture'      => true,
                'description'  => 'Оплата заявки '.$this->advertisement->id,
                'metadata'     => [
                    'type' => YooKassaPaymentType::ClientAdvertisement->value,
                    'id'   => $this->advertisement->id,
                ],
            ],
            $idempotenceKey
        );

        $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();

        $this->redirect($confirmationUrl);
    }

}
