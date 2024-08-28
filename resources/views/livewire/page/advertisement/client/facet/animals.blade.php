<div>
    <ul class="list-group">
        @foreach(\App\Domain\Enum\AnimalType::cases() as $animal)
            <li class="list-group-item">
                <input
                        wire:model.live="selectAnimals"
                        class="form-check-input me-1"
                        type="checkbox"
                        value="{{ $animal->value }}"
                        id="animal_{{ $animal->value }}"
                >
                <label
                        class="form-check-label"
                        for="animal_{{ $animal->value }}"
                >
                    {{ $animal->name() }}
                    @if(isset($this->animals[$animal->value]))
                        ( {{$this->animals[$animal->value]}} )
                    @else
                        ( 0 )
                    @endif
                </label>
            </li>
        @endforeach
    </ul>
</div>
