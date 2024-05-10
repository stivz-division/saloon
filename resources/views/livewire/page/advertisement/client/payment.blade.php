<div>
    <div class="p-3 rounded-4 bg-light mb-3">
        <h1 class="display-4">Оплата!</h1>
        <p class="fs-4">
            Чтобы объявление всегда было доступно его нужно оплатить.
            {{ config('yookassa.client-advertisement') }} руб.
        </p>

        <div>
            <button wire:click.prevent="paymentAdvertisement" type="button" class="btn btn-primary">
                Оплатить
            </button>
        </div>

    </div>
</div>
