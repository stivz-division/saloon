<div>
    <h1>Профиль</h1>

    @if($user->isMaster())
        <div class="mb-3">
            <livewire:page.profile.master.subscription :user="$user"/>
        </div>
        <div class="mb-3">
            <livewire:page.profile.master.my-advertisements :user="$user"/>
        </div>
    @endif

    @if($user->isClient())
        <div class="mb-3">
            <livewire:page.profile.client.my-advertisements :user="$user"/>
        </div>
    @endif

    <div class="mb-3">
        <livewire:page.profile.avatar :user="$user"/>
    </div>

    @if($user->ref !== null)
        <div class="mb-3">
            @include('components.shared.ref-card', [
            'ref' => $user->ref
        ])
        </div>
    @endif

    <livewire:page.profile.contacts :user="$user"/>

    @if($user->isMaster())
        <div class="mb-3">
            <livewire:page.profile.master.ref-link :user="$user"/>
        </div>

        <livewire:page.profile.master.master-profile :user="$user"/>
    @endif

    @if($user->isClient())
        <livewire:page.profile.client.pet :user="$user"/>
    @endif

</div>
