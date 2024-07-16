<div @class(['mb-3'])>
    @error('name')
    <div class="alert alert-danger my-2">{{ $message }}</div>
    @enderror
    <label @class(['form-label']) for="name">Название</label>
    <input
            @class(['form-control'])
            type="text"
            name="name"
            id="name"
            wire:model="name"
            placeholder="Введите название..."
            required
    >
</div>