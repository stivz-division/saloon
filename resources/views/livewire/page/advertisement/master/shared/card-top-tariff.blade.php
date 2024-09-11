<div class="card mb-4 rounded-3 shadow-sm">
    <div class="card-header py-3">
        <h4 class="my-0 fw-normal">
            {{ $item->name }}
        </h4>
    </div>
    <div class="card-body">
        <h1 class="card-title pricing-card-title">
            @if(floor($item->price) != $item->price)
                {{ number_format($item->price, 2, ',', ' ') }}₽
            @else
                {{ number_format($item->price, 0, ',', ' ') }}₽
            @endif
            <small class="text-body-secondary fw-light">/{{$item->count_days}} дней</small>
        </h1>
        <ul class="list-unstyled mt-3 mb-4">
            @if($item->type === \App\Domain\Enum\AdvertisementTopTariffsType::Minute)
                <li>Каждые {{ $item->minutes }} минут</li>
            @else
                <li>Каждый день в {{$item->start_time}}</li>
            @endif

        </ul>
        @if($buy)
            <button
                wire:click="raiseTop({{ $item->id }})"
                type="button"
                class="w-100 btn btn-lg btn-primary"
            >
                Поднять в топ
            </button>
        @endif
    </div>
</div>
