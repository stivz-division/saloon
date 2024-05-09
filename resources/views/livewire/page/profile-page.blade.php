<div>
    <h1>Профиль</h1>

    <livewire:page.profile.contacts :user="$user"/>

    @if($user->isMaster())
        <livewire:page.profile.master.master-profile :user="$user"/>
    @endif

    @if($user->isClient())
        <livewire:page.profile.client.pet :user="$user"/>
    @endif

</div>
