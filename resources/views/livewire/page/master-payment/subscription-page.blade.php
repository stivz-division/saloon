<div>
    <div class="p-3 rounded-4 bg-light mb-3">
        <h1>Подписка</h1>
        <p class="fs-4">Что даст подписка.</p>
        <ul>
            <li>Просмотр объявлений</li>
        </ul>


        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

            @foreach($this->tariffs() as $item)
                <div class="col">
                    @include('livewire.page.view-subscription.card', [
                        'item' => $item,
                        'buy' => true
                    ])
                </div>
            @endforeach
        </div>


        {{--        <div>--}}
        {{--            <button wire:click="paymentAdvertisement" type="button" class="btn btn-primary fs-5">--}}
        {{--                Купить подписку за {{ config('yookassa.master-subscription') }} руб.--}}
        {{--            </button>--}}
        {{--        </div>--}}

        {{--        <hr>--}}

        {{--        <livewire:components.promocode--}}
        {{--                :type="$promocodeType"--}}
        {{--                @activate="activatePromocode"--}}
        {{--        />--}}

    </div>
</div>
