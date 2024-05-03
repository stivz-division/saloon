<div>

    <div class="p-3 rounded-2 bg-light mb-3">
        <h2>Общие настройки</h2>
        <x-alert.block/>
        <div>
            <div class="form-check">
                <input wire:model="is_veterinarian" class="form-check-input" type="checkbox" id="is_veterinarian">
                <label class="form-check-label" for="is_veterinarian">
                    Ветеринар
                </label>
            </div>
        </div>

        <div>
            <div class="form-check">
                <input wire:model="is_delivering_pet" class="form-check-input" type="checkbox" id="is_delivering_pet">
                <label class="form-check-label" for="is_delivering_pet">
                    Доставляю питомца
                </label>
            </div>
        </div>


        <div class="form-check">
            <input wire:model="is_home_check_out" class="form-check-input" type="checkbox" id="is_home_check_out">
            <label class="form-check-label" for="is_home_check_out">
                Выезд на дом
            </label>
        </div>

        <div class="form-check mb-3">
            <input wire:model="is_at_home" class="form-check-input" type="checkbox" id="is_at_home">
            <label class="form-check-label" for="is_at_home">
                У себя
            </label>
        </div>

        <div>
            <button type="button" wire:click="saveInfo" class="btn btn-primary d-inline-block">
                Сохранить изменения
            </button>
        </div>
    </div>


    <div class="p-3 rounded-2 bg-light">
        <livewire:page.profile.master.location :user="$user"/>
    </div>

</div>