<div>
    <div class="card card-body">
        <p>Укажите где вы там то там</p>
        <div class="mb-2">
            <livewire:components.multi-select
                    :service="$service"
                    @change-selected="setLocations($event.detail.selected)"
                    placeholder="Укажите места работы"
            />


        </div>


        <div>
            @if(count($locations))
                <button type="button" class="btn btn-primary d-inline-block">Сохранить</button>
            @endif
        </div>

    </div>
</div>
