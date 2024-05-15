<?php

namespace App\Livewire\Page\MasterPayment;

use App\Domain\Enum\PromocodeType;
use App\Domain\Enum\YooKassaPaymentType;
use App\Repositories\ClientAdvertisementRepository;
use App\Services\MasterClientAdvertisementService;
use Livewire\Component;
use YooKassa\Client;
use YooKassa\Model\CurrencyCode;

class ClientAdvertisementPage extends Component
{

    /** @var \App\Models\ClientAdvertisement */
    public $advertisement;

    public $promocodeType;

    public function activatePromocode()
    {
        app(MasterClientAdvertisementService::class)
            ->activate(
                $this->advertisement,
                auth()->user()->id
            );

        $this->redirectRoute('client.advertisement.show', [
            'advertisement' => $this->advertisement->uuid,
        ]);
    }

    public function mount($advertisement)
    {
        $clientAdvertisementRepository
            = app(ClientAdvertisementRepository::class);

        /** @var \App\Models\ClientAdvertisement $advertisement */
        $advertisement
            = $clientAdvertisementRepository->getByUuid($advertisement);

        if ($advertisement === null) {
            abort(404);
        }

        if ($advertisement->itMasterPayment(
            auth()->user()->id
        )
        ) {
            $this->redirectRoute('client.advertisement.show', [
                'advertisement' => $advertisement->uuid,
            ]);
        }

        $this->advertisement = $advertisement;
        $this->promocodeType = PromocodeType::MasterClientAdvertisement->value;
    }

    public function paymentAdvertisement()
    {
        $client = app(Client::class);

        $idempotenceKey = uniqid('', true);

        $response = $client->createPayment(
            [
                'amount'       => [
                    'value'    => config('yookassa.master-client-advertisement'),
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
                'description'  => 'Оплата мастером заявки '
                    .$this->advertisement->id,
                'metadata'     => [
                    'type'             => YooKassaPaymentType::MasterClientAdvertisement->value,
                    'advertisement_id' => $this->advertisement->id,
                    'master_id'        => auth()->id(),
                ],
            ],
            $idempotenceKey
        );

        $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();

        $this->redirect($confirmationUrl);
    }

    public function render()
    {
        return view('livewire.page.master-payment.client-advertisement-page');
    }

}
