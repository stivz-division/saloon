<div>
    <div class="p-3 rounded-4 bg-light mb-3">
        <h2>Мои контакты</h2>
        <x-alert.block/>

        <form wire:submit.prevent="saveContacts">
            <div class="mb-3">
                <label for="phone" class="form-label">Номер телефона</label>
                <input
                    maxlength="12"
                    wire:model="phone"
                    type="text"
                    class="form-control"
                    name="phone"
                    id="phone"
                    placeholder="Номер телефона..."
                >
                <span class="small text-muted">Пример: +79993456789</span>
            </div>

            <div class="mb-3">
                <label for="dop_phone" class="form-label">Дополнительный номер телефона</label>
                <input
                    maxlength="12"
                    wire:model="dop_phone"
                    type="text"
                    class="form-control"
                    name="dop_phone"
                    id="dop_phone"
                    placeholder="Дополнительный номер телефона..."
                >
                <span class="small text-muted">Пример: +79993456789</span>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Telegram</label>
                <input
                    wire:model="telegram"
                    type="text"
                    class="form-control"
                    name="telegram"
                    id="telegram"
                    placeholder="Telegram..."
                >
                @error('telegram')
                <h2>ERRORR</h2>
                @enderror
                <span class="small text-muted">Пример: @test</span>
            </div>

            <div class="mb-3">
                <label for="WhatsApp" class="form-label">WhatsApp</label>
                <input
                    maxlength="12"
                    wire:model="whatsapp"
                    type="text"
                    class="form-control"
                    name="whatsapp"
                    id="WhatsApp"
                    placeholder="WhatsApp..."
                >
                <span class="small text-muted">Пример: +79993456789</span>
            </div>

            <input class="btn btn-primary" type="submit" value="Сохранить">
        </form>

    </div>
</div>
