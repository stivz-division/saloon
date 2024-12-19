<?php

namespace App\Livewire\Page\MasterPayment;

use App\Domain\Enum\PromocodeType;
use App\Domain\Enum\YooKassaPaymentType;
use App\Repositories\VIewSubscriptionRepository;
use App\Services\UserService;
use Livewire\Attributes\Computed;
use Livewire\Component;
use YooKassa\Client;
use YooKassa\Model\CurrencyCode;

class SubscriptionPage extends Component
{

    public $promocodeType;

    public function mount()
    {
        $user = auth()->user();

        if ($user->isActiveSubscription()) {
            session()->flash('success', 'У вас уже есть подписка');

            $this->redirectRoute('welcome');
        }

        $this->promocodeType = PromocodeType::MasterSubscription->value;
    }

    public function activatePromocode()
    {
        $userService = app(UserService::class);

        $userService->masterPaymentSubscribe(
            auth()->user(),
        );

        $this->redirectRoute('welcome');
    }

    #[Computed]
    public function tariffs()
    {
        return app(VIewSubscriptionRepository::class)->tarrifs();
    }

    public function paymentAdvertisement($tariff)
    {
        $tariff = app(VIewSubscriptionRepository::class)->getById($tariff);

        if ($tariff === null) {
            return;
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
                'description'  => 'Оплата мастером подписки на просмотр',
                'metadata'     => [
                    'type'              => YooKassaPaymentType::MasterSubscription->value,
                    'view_subscribe_id' => $tariff->id,
                    'master_id'         => auth()->id(),
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
