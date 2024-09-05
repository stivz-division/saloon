<div class="card mb-4 rounded-3 shadow-sm">
    <div class="card-header py-3">
        <h4 class="my-0 fw-normal">
            {{ $advertisement->title }}
        </h4>
        @if($advertisement->is_published)
            <span class="text-muted small">
                {{ $advertisement->created_at->toDateTimeString() }}
            </span>
        @endif
    </div>
    <div class="card-body">
        <h1 class="card-title pricing-card-title">
            {{$advertisement->price}}₽
        </h1>
        <p>
            {{ $advertisement->description }}
        </p>

        @if($advertisement->locations->count())
            <div class="bg-dark p-2 text-white rounded-3 mb-2">
                <div class="mb-1">
                        <span class="badge text-bg-primary">
                            Место оказания услуги
                        </span>
                </div>
                @foreach($advertisement->locations as $location)
                    <span class="badge text-bg-warning">{{$location->location}}</span>
                @endforeach
            </div>
        @endif

        @if($advertisement->animals->count())
            <div class="bg-dark p-2 text-white rounded-3 mb-2">
                <div class="mb-1">
                        <span class="badge text-bg-primary">
                            С кем работаю
                        </span>
                </div>

                @foreach($advertisement->animals as $animal)
                    <span class="badge text-bg-warning">{{$animal->title->name()}}</span>

                @endforeach
            </div>
        @endif

        @if($advertisement->breeds->count())
            <div class="bg-dark p-2 text-white rounded-3 mb-2">
                <div class="mb-1">
                        <span class="badge text-bg-primary">
                            Породы
                        </span>
                </div>

                @foreach($advertisement->breeds as $breed)
                    <span class="badge text-bg-warning text-wrap">{{$breed->name}}</span>
                @endforeach
            </div>
        @endif

        @if($advertisement->petWeights->count())
            <div class="bg-dark p-2 text-white rounded-3 mb-2">
                <div class="mb-1">
                        <span class="badge text-bg-primary">
                            Вес
                        </span>
                </div>
                @foreach($advertisement->petWeights as $petWeight)
                    <span class="badge text-bg-warning">{{$petWeight->title}}</span>
                @endforeach
            </div>
        @endif

        @if($advertisement->images()->count())
            <div class="row row-cols-auto g-1">
                @foreach($advertisement->images() as $image)
                    <div class="col p-1">
                        <img
                                class="img-fluid"
                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 25px"
                                src="{{ $image->getFullUrl() }}"
                                alt="SERVICE IMAGE"
                        >
                    </div>
                @endforeach
            </div>

        @endif

    </div>
    @if($control)
        <div class="card-footer text-end row g-2">
            <div class="col">
                <a
                        href="{{ route('master.advertisement.edit', [
                        'masterAdvertisement' => $advertisement->id
                    ]) }}"
                        class="btn btn-primary w-100"
                >
                    Редактировать
                </a>
            </div>
            <div class="col">
                <button
                        wire:click.prevent="deleteAdvertisement({{ $advertisement->id }})"
                        wire:confirm="Вы уверены, что хотите удалить услугу?"
                        class="btn btn-danger w-100"
                >
                    Удалить
                </button>
            </div>

            @if($advertisement->is_published)
                <div class="col">
                    <button
                            wire:click.prevent="archiveAdvertisement({{ $advertisement->id }})"
                            wire:confirm="Вы уверены, что хотите отправить услугу в архив?"
                            class="btn btn-dark w-100"
                    >
                        В архив
                    </button>
                </div>
            @else
                <div class="col">
                    <button
                            wire:click.prevent="publishAdvertisement({{ $advertisement->id }})"
                            wire:confirm="Вы уверены, что хотите опубликовать услугу?"
                            class="btn btn-dark w-100"
                    >
                        Опубликовать
                    </button>
                </div>
            @endif

            @if($advertisement->advertisementTopTariff === null)
                <div class="col">
                    <a
                            href="{{ route('master.advertisement.top', [
                        'masterAdvertisement' => $advertisement->id
                    ]) }}"
                            class="btn btn-warning w-100"
                    >
                        Поднять в ТОП
                    </a>
                </div>
            @endif
        </div>
    @endif
</div>