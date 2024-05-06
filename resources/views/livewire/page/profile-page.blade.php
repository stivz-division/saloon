<div>
    <h1>Профиль</h1>

    @if($user->isMaster())
        <livewire:page.profile.master.master-profile :user="$user"/>
    @endif

</div>
