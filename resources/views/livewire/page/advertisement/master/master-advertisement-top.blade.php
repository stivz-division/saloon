<div>
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal text-body-emphasis">Поднятие в ТОП</h1>
        <p class="fs-5 text-body-secondary">Не упустите возможность улучшить свой опыт использования нашего сервиса и
            наслаждаться всеми его преимуществами. Оформите подписку прямо сейчас и начните пользоваться всем, что мы
            можем вам предложить!</p>
    </div>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

        @foreach($tariffs as $item)
            <div class="col">
                @include('livewire.page.advertisement.master.shared.card-top-tariff', [
                    'item' => $item,
                    'buy' => true
                ])
            </div>
        @endforeach
    </div>
</div>
