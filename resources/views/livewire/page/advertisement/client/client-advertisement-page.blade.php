<div>
    <h1>Добавление объявления</h1>

    <x-alert.block/>

    <form wire:submit.prevent="saveClientAdvertisement">
        <div class="p-3 rounded-4 bg-light mb-3">
            <h2>Выберите домашнее животное.</h2>

            @error('pet')
            <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror

            <select wire:model.live="pet" class="form-select" name="pet" id="pet"
                    aria-label="Домашнее животное" required>
                <option value="">Выберите домашнее животное</option>
                @foreach($userPets as $userPet)
                    <option value="{{ $userPet->id }}">{{ $userPet->nickname }}</option>
                @endforeach
            </select>
            @if($petObject !== null)
                <div class="mt-1">
                    @include('livewire.page.profile.client.shared.pet-card', [
                        'pet' => $petObject,
                        'delete' => false
                    ])
                </div>
            @endif
        </div>


        <div class="p-3 rounded-4 bg-light mb-3">
            <h2>Описание требуемой услуги</h2>
            @error('description')
            <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror
            <textarea wire:model="description" class="form-control" name="about" id="about" rows="12"
                      required></textarea>
        </div>

        <div class="p-3 rounded-4 bg-light mb-3">
            <h2 class="mb-0">Укажите где вы хотите получить услуги</h2>

            @error('locations')
            <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror

            <livewire:components.multi-select
                    :service="$serviceLocation"
                    @change-selected="setLocations($event.detail.selected)"
                    max="1"
                    :set="$locations"
                    placeholder="Укажите места работы"
            />
        </div>

        <div class="p-3 rounded-4 bg-light mb-3">
            <h2 class="mb-0">Желаемая дата и время получения услуги по МСК</h2>

            @error('datetime')
            <div class="alert alert-danger my-2">{{ $message }}</div>
            @enderror

            <input
                    wire:model="datetime"
                    type="datetime-local"
                    class="form-control"
                    min="{{ now()->toDateString() }}"
                    id="datetime"
                    aria-describedby="Желаемая дата получения услуги"
                    pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}"
                    required
            >
        </div>

        <div>
            <input class="btn btn-primary" type="submit" value="Создать объвление">
        </div>
    </form>

    <div class="p-3 rounded-4 bg-light mt-3">
        <p>
            Размещение 3 часа халява потом нужно платить!
        </p>

    </div>

</div>
