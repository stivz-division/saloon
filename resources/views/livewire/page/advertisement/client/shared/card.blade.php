@if($published && $advertisement->is_published)
    <div class="badge rounded-pill text-bg-success mb-3">ПУБЛИКУЕТСЯ</div>
@endif

<div class="p-3 rounded-4 bg-light mt-1 mb-1">
    <h4
        class="mb-0"
        style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
    >
        {{ $advertisement->description }}
    </h4>
    <div class="mb-3 small text-muted">
        {{ $advertisement->published_at->toDateTimeString() }}
    </div>
</div>

@if($contacts)
    @include('livewire.page.advertisement.client.shared.contacts')
@endif

<div class="p-3 rounded-4 bg-light mb-3">
    @include('livewire.page.profile.client.shared.pet-card', [
        'pet' => $advertisement->pet,
        'delete' => false
    ])
</div>

@if($advertisement->yandexLocation)
    <div class="p-3 rounded-4 bg-light mb-3">
        {{--        <h2>Локация</h2>--}}

        <h5>{{ $advertisement->yandexLocation->location }}</h5>

    </div>
@endif

@if($advertisement->datetime_service_at)
    <div class="p-3 rounded-4 bg-light mb-3">
        <h6>Желаемая дата оказания услуги</h6>

        {{ $advertisement->datetime_service_at->format('d.m.Y H') }}

        @if($advertisement->datetime_service_at->isPast() === false)
            <span class="badge rounded-pill text-bg-success">ЕЩЕ МОЖНО УСПЕТЬ</span>
        @endif

    </div>
@endif

@if(isset($control) && $control)
    <div class="card-footer text-end row g-2">
        {{--        <div class="col">--}}
        {{--            <button--}}
        {{--                    wire:click.prevent="deleteAdvertisement({{ $advertisement->id }})"--}}
        {{--                    wire:confirm="Вы уверены, что хотите удалить услугу?"--}}
        {{--                    class="btn btn-danger w-100"--}}
        {{--            >--}}
        {{--                Удалить--}}
        {{--            </button>--}}
        {{--        </div>--}}

        @if($advertisement->is_published)
            <div class="col">
                <button
                    wire:click.prevent="archiveAdvertisement({{ $advertisement->id }})"
                    {{--                        wire:confirm="Вы уверены, что хотите отправить услугу в архив?"--}}
                    class="btn btn-dark w-100"
                >
                    В архив
                </button>
            </div>
        @else
            <div class="col">
                <button
                    wire:click.prevent="publishAdvertisement({{ $advertisement->id }})"
                    {{--                    wire:confirm="Вы уверены, что хотите опубликовать услугу?"--}}
                    class="btn btn-dark w-100"
                >
                    Опубликовать
                </button>
            </div>
        @endif

        <div class="col">
            <a
                href="{{ route('client.advertisement.create', ['link' => $advertisement->id]) }}"
                class="btn btn-primary w-100"
            >
                Создать на основе
            </a>
        </div>
    </div>
@endif
