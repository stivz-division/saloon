<div>
    @if($empty === false)
        <input wire:model.live="value" type="search" class="form-control"
               id="searchInput"
               @disabled($max !== null && $selected->count() >= $max)
               @readonly($max !== null && $selected->count() >= $max)
               placeholder="{{ $placeholder }}">
    @endif

    @if($selected->count())
        @foreach($selected as $item)
            <span
                    wire:click="deleteSelect({{ $item['value'] }})"
                    class="badge text-bg-primary"
            >
                {{ $item['name'] }}
                <i class="bi bi-x-circle me-0 ms-2"></i>
            </span>
        @endforeach
    @endif

    @if($values->count() && ($max === null || $selected->count() < $max))
        <div class="bg-light p-3 mt-1">
            <ul class="list-group">
                @foreach($values as $item)
                    <li
                            wire:click.prevent="selectItem({{ $item['value'] }}, '{{ $item['name'] }}')"
                            class="list-group-item list-group-item-action">{{ $item['name'] }}</li>
                @endforeach

            </ul>
        </div>
    @endif
</div>
