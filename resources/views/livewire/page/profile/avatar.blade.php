<div>
    <div class="p-3 rounded-4 bg-light">
        <h2>Мое фото</h2>
        <x-alert.block/>
        <form wire:submit.prevent="updateAvatar">
            <div>
                @if($avatar && in_array($avatar->extension(), $accessExtensions))
                    <img
                            onclick="document.getElementById('avatar').click();"
                            class="rounded-circle"
                            height="190"
                            width="190"
                            src="/storage/livewire-tmp/{{ $avatar->getFilename() }}"
                            alt="{{ __("Фото") }}"
                    >
                @else
                    @if(!is_null($user->avatar_path))
                        <img
                                onclick="document.getElementById('avatar').click();"
                                class="rounded-circle"
                                height="190"
                                width="190"
                                src="/storage/{{$user->avatar_path}}"
                                alt="{{ __("Фото") }}"
                        >
                    @else
                        {{ __("Фото не установлен") }}
                    @endif
                @endif
            </div>
            <input
                    wire:model="avatar"
                    id="avatar"
                    class="d-none"
                    type="file"
                    name="avatar"
                    accept="image/png, image/jpeg"
            >
            <div class="w-100 mt-2">
                @if($avatar !== null)
                    <button
                            type="submit"
                            class="btn btn-outline-primary"
                    >
                        {{ __('Сохранить') }}
                    </button>
                @else
                    <button
                            type="button"
                            onclick="document.getElementById('avatar').click();"
                            class="btn btn-outline-secondary"
                    >
                        {{ __('Редактировать') }}
                    </button>
                @endif
            </div>
        </form>
    </div>

</div>
