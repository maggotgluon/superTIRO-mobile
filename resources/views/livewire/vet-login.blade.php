<div class="py-6 min-h-[50vh]">
    <!-- <x-input label="ชื่อคลินิก หรือ โรงพยาบาลสัตว์" wire:model="user" /> -->

    <x-toggle label="Use username for admin login" wire:model.lazy="adm" />
    
    @if ($error)
        <x-badge negative label="{{$error}}" />
    @endif
    <x-errors />
    @if ($user||$adm_user)
    login as {{ $user??$adm_user}}
    @endif
    @if ($adm)
        <x-input wire:model.lazy="adm_user" label="Username"
        class="{{$error!=''?'ring-secondary-red':''}}"/>
    @else
    <!-- <x-input wire:model.defer="user" label="รหัสร้านค้า"
    class="{{$error!=''?'ring-secondary-red':''}}"/> -->
    <x-select
        label="ชื่อคลินิก หรือ โรงพยาบาลสัตว์"
        placeholder="ชื่อคลินิก หรือ โรงพยาบาลสัตว์"
        :options="$vet_list"
        option-label="name"
        option-value="id"
        wire:model.lazy="user"/>
            
    @endif
    <x-inputs.password class="py-4 {{$error!=''?'ring-secondary-red':''}}" label="รหัสผ่าน" placeholder="รหัสผ่าน" wire:model.defer="password" />

    <div class="py-4">
        <x-checkbox label="จดจำรหัสผ่านของฉันเอาไว้" wire:model.defer="remember_me" />
    </div>

    <x-button class="my-4" lg right-icon="chevron-right" primary
                wire:click="login" type="button" label="login" />

</div>
