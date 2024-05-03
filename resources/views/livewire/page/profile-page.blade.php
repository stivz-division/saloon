<div>
    <h1>Профиль</h1>

    @if($user->isMaster())

        <livewire:page.profile.master.master-profile :user="$user"/>

        {{--        @include('livewire.page.profile.shared.master')--}}
    @endif

</div>
