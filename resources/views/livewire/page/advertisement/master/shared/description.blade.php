<div @class(['mb-3'])>
    @error('description')
    <div class="alert alert-danger my-2">{{ $message }}</div>
    @enderror
    <label @class(['form-label']) for="description">Описание</label>
    <textarea
            wire:model="description"
            class="form-control"
            name="description"
            id="description"
            rows="12"
            required

    ></textarea>
</div>