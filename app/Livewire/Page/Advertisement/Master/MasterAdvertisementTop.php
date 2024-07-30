<?php

namespace App\Livewire\Page\Advertisement\Master;

use App\Domain\Enum\YooKassaPaymentType;
use App\Models\MasterAdvertisement;
use App\Repositories\AdvertisementTopTariffRepository;
use Livewire\Component;
use YooKassa\Client;
use YooKassa\Model\CurrencyCode;

class MasterAdvertisementTop extends Component
{

    public MasterAdvertisement $masterAdvertisement;

    public function raiseTop(int $idTariff)
    {
        if (auth()->user()->can('update', $this->masterAdvertisement)
            === false
        ) {
            abort(403);
        }

        $tariff = app(AdvertisementTopTariffRepository::class)
            ->getById($idTariff);

        if ($tariff === null) {
            abort(404);
        }

        $client = app(Client::class);

        $idempotenceKey = uniqid('', true);

        $response = $client->createPayment(
            [
                'amount'       => [
                    'value'    => $tariff->price,
                    'currency' => CurrencyCode::RUB,
                ],
                'confirmation' => [
                    'type'       => 'redirect',
                    'locale'     => 'ru_RU',
                    'return_url' => route('welcome'),
                ],
                'capture'      => true,
                'description'  => 'Оплата мастером поднятия объявления в топ',
                'metadata'     => [
                    'type'             => YooKassaPaymentType::MasterTopAdvertisement->value,
                    'tariff_id'        => $tariff->id,
                    'advertisement_id' => $this->masterAdvertisement->id,
                    'user_id'          => auth()->id(),
                ],
            ],
            $idempotenceKey
        );

        $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();

        $this->redirect($confirmationUrl);
    }

    public function render()
    {
        return view('livewire.page.advertisement.master.master-advertisement-top',
            [
                'tariffs' => app(AdvertisementTopTariffRepository::class)->list(),
            ]);
    }

}
