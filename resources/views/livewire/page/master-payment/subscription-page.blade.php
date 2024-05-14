<div>
    <div class="p-3 rounded-4 bg-light mb-3">
        <h1>Подписка</h1>
        <p class="fs-4">Что даст подписка.</p>
        <ul>
            <li>Просмотр объявлений</li>
        </ul>

        <div>
            <button wire:click="paymentAdvertisement" type="button" class="btn btn-primary fs-5">
                Купить подписку за {{ config('yookassa.master-subscription') }} руб.
            </button>
        </div>

    </div>
</div>
