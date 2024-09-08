<div class="card mb-4 rounded-3 shadow-sm position-relative">
    @if($item->stock !== null)
        <div
                class="text-start position-absolute"
                style="top: -14px"
        >
            <span class="badge rounded-pill bg-danger">
                <i class="bi bi-emoji-surprise-fill me-1"></i>
                Действует акция
            </span>
        </div>
    @endif
    <div class="card-header py-3">
        <h4 class="my-0 fw-normal">
            {{ $item->name }}
        </h4>
    </div>
    <div class="card-body">
        <h1 class="card-title pricing-card-title">
            @if($item->stock === null)
                {{$item->price}}₽
            @else
                <span class="text-danger">
                   {{ $item->stock->price }}₽
                </span>
                <small
                        class="text-body-secondary text-decoration-line-through fw-light"
                        style="font-size: 20px"
                >
                    {{$item->price}}₽
                </small>
                <span
                        class="text-danger"
                        style="font-size: 20px"
                >
                    &nbsp;-{{ $item->stock->percent }}%
                </span>
            @endif

        </h1>
        @if($item->stock !== null)
            <div class="text-muted small text-decoration-underline">
                Действует до: {{ $item->stock->end_at->format('d.m.Y H:i') }}
            </div>
        @endif
        <ul class="list-unstyled mt-3 mb-4">
            <li>Объявлений: {{ $item->advertisement_count }} шт.</li>
            <li>Срок размещения: {{ $item->published_days }} дней</li>
            <li>Приоритетная поддержка по электронной почте</li>
            <li>Доступ к справочному центру</li>
        </ul>
        @if($buy)
            <button
                    wire:click="subscribe({{ $item->id }})"
                    type="button"
                    class="w-100 btn btn-lg btn-primary"
            >
                Оформить
            </button>
        @endif
    </div>
</div>
