<div>
    <div class="p-3 rounded-4 bg-light mb-3">
        <h2>Домашние животные</h2>
        <x-alert.block/>
        @if($pets->count())

            @php
                /** @var \App\Models\Pet $item */
            @endphp
            <div class="row row-cols-auto my-2 g-2">

                @foreach($pets as $item)

                    @php
                        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media|null $image */
                            $image = $item->image();
                    @endphp

                    <div class="col position-relative">

                        <div class="p-2 bg-secondary rounded-3 h-100"
                             style="width: 206px"
                        >
                            <div wire:click.prevent="deletePet({{ $item->id }})"
                                 class="position-absolute"
                                 style="top: 10px; right: 15px; cursor: pointer">
                                <div
                                        class="bg-white d-flex justify-content-center align-items-center"
                                        style="width: 30px; height: 30px; border-radius: 50%"
                                >
                                    <i class="bi bi-trash-fill text-danger"></i>

                                </div>
                            </div>

                            <span class="badge text-bg-primary">
                                {{ $item->animal->title->name() }}
                            </span>

                            <div class="w-100 d-inline-block text-white fs-3">
                                {{ $item->nickname }}
                            </div>

                            @if($image !== null)
                                <a href="{{ $image->getFullUrl() }}" target="_blank">
                                    <img
                                            class="rounded-3"
                                            style="width: 190px; height: 190px; object-fit: cover"
                                            src="{{ $image->getFullUrl() }}"
                                            alt="{{ $item->nickname }}"
                                    >
                                </a>
                            @else
                                <div
                                        class="bg-light rounded-3 border d-flex justify-content-center align-items-center"
                                        style="width: 190px; height: 190px"
                                >
                                    <i class="bi bi-card-image me-0 fs-1"></i>
                                </div>
                            @endif

                            @if($item->breed)
                                <div class="text-white small">
                                    {{ $item->breed->name }}
                                </div>
                            @endif

                            @if($item->petWeight)
                                <div class="text-white small">
                                    {{ $item->petWeight->title->name() }}
                                </div>
                            @endif


                        </div>

                    </div>
                @endforeach
            </div>

        @endif
        <form wire:submit.prevent="savePet">
            <div class="mb-3">
                <label for="nickname" class="form-label">Кличка</label>
                <input wire:model="nickname" type="text" class="form-control"
                       id="nickname"
                       placeholder="Кличка" required>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Вы можете загрузить фото или видео</label>
                <input wire:model="file" class="form-control" accept="image/*" name="file" type="file" id="file">
            </div>
            <div class="mb-3">
                <label for="animal" class="form-label">Категория</label>
                <select wire:model.live="animal" id="animal" class="form-select" aria-label="Выберите категорию"
                        required>
                    <option selected value="">Выберите категорию</option>
                    @foreach($animals as $item)
                        <option value="{{ $item->id }}">{{ $item->title->name() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="pet_weight" class="form-label">Вес</label>
                <select wire:model="pet_weight" id="pet_weight" class="form-select" aria-label="Выберите вес" required>
                    <option selected value="">Выберите вес</option>
                    @foreach($petWeights as $petWeight)
                        <option value="{{ $petWeight->id }}">{{ $petWeight->title->name() }}</option>
                    @endforeach
                </select>
            </div>
            @if($animal && (int) $animal === $dogAnimal->id)
                <div class="mb-3">
                    <label for="breed" class="form-label">Порода</label>
                    <select wire:model="breed" id="breed" class="form-select" aria-label="Выберите породу" required>
                        <option selected value="">Выберите породу</option>
                        @foreach($breeds as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <input class="btn btn-primary" type="submit" value="Сохранить">

        </form>
    </div>
</div>
