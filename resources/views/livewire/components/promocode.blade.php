<div>
    <div class="p-3 rounded-4 bg-secondary text-white mb-3">
        <x-alert.block/>
        <h2>Активация промокода</h2>
        <form wire:submit.prevent="activate">
            <div class="mb-3">
                <label for="code" class="form-label">Промокод</label>
                <input wire:model="code" type="text" class="form-control"
                       id="code"
                       placeholder="Промокод..." required>
            </div>

            <div>
                <input type="submit" class="btn btn-primary" value="Активировать">
            </div>
        </form>
    </div>
</div>
