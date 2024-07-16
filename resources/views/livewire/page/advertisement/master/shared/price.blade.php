<div @class(['mb-3'])>
    @error('name')
    <div class="alert alert-danger my-2">{{ $message }}</div>
    @enderror
    <label @class(['form-label']) for="name">Стоимость</label>
    <input
            @class(['form-control'])
            type="number"
            name="price"
            step="0.1"
            id="price"
            wire:model="price"
            placeholder="Введите стоимость..."
            required
    >
</div>