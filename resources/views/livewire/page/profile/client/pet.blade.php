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

                    <div class="col">

                        @include('livewire.page.profile.client.shared.pet-card', [
                            'pet' => $item,
                            'delete' => true
                        ])

                    </div>
                @endforeach
            </div>

        @endif
    </div>
    <div class="p-3 rounded-4 bg-light mb-3">
        <h2>Добавить питомца</h2>
        <form wire:submit.prevent="savePet">
            <div class="mb-3">
                <label
                        for="nickname"
                        class="form-label"
                >Кличка</label>
                <input
                        wire:model="nickname"
                        type="text"
                        class="form-control"
                        id="nickname"
                        placeholder="Кличка"
                        required
                >
            </div>
            <div class="mb-3">
                <label
                        for="file"
                        class="form-label"
                >Вы можете загрузить фото или видео</label>
                <input
                        wire:model="file"
                        class="form-control"
                        accept="image/*"
                        name="file"
                        type="file"
                        id="file"
                >
            </div>
            <div class="mb-3">
                <label
                        for="animal"
                        class="form-label"
                >Категория</label>
                <select
                        wire:model.live="animal"
                        id="animal"
                        class="form-select"
                        aria-label="Выберите категорию"
                        required
                >
                    <option
                            selected
                            value=""
                    >Выберите категорию
                    </option>
                    @foreach($animals as $item)
                        <option value="{{ $item->id }}">{{ $item->title->name() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label
                        for="pet_weight"
                        class="form-label"
                >Вес</label>
                <select
                        wire:model="pet_weight"
                        id="pet_weight"
                        class="form-select"
                        aria-label="Выберите вес"
                        required
                >
                    <option
                            selected
                            value=""
                    >Выберите вес
                    </option>
                    @foreach($petWeights as $petWeight)
                        <option value="{{ $petWeight->id }}">{{ $petWeight->title->name() }}</option>
                    @endforeach
                </select>
            </div>
            @if($animal && (int) $animal === $dogAnimal->id)
                @include('livewire.page.advertisement.master.shared.breed', ['max' => 1])
            @endif

            <input
                    class="btn btn-primary"
                    type="submit"
                    value="Добавить"
            >

        </form>
    </div>
</div>
