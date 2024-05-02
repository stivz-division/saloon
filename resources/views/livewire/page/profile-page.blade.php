<div>
    <h1>Профиль</h1>

    @if($user->isMaster())
        <livewire:page.profile.location :user="$user"/>
    @endif

</div>
