<div>
    <div class="p-3 rounded-4 bg-light mb-3">
        <h1>Просмотр заявки</h1>
        <p class="fs-4">Чтобы просмотреть заявку, вам необходимо приобрести доступ к ней или оформить
            подписку.</p>

        <div>
            <button wire:click="paymentAdvertisement" type="button" class="btn btn-primary fs-5">
                Купить доступ к заявке за {{ config('yookassa.master-client-advertisement') }} руб.
            </button>
        </div>

        <a class="mt-3 d-block" href="{{ route('master-payment.subscription') }}">Или оформить подписку</a>

        <hr>

        <livewire:components.promocode :type="$promocodeType" @activate="activatePromocode"/>


    </div>
</div>
