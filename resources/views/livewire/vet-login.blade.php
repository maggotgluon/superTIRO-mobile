<div class="py-6 min-h-[50vh]">
    <!-- <x-input label="ชื่อคลินิก หรือ โรงพยาบาลสัตว์" wire:model="user" /> -->
    
    
    <x-toggle label="Use username for admin login" wire:model.lazy="adm" />
    
    @if ($adm)        
        <x-input wire:model.defer="adm_user" label="Username" />
    @else
        <x-input wire:model.defer="user" label="ชื่อคลินิก หรือ โรงพยาบาลสัตว์" />
    <!-- <x-native-select 
            label="ชื่อคลินิก หรือ โรงพยาบาลสัตว์"
            placeholder="ชื่อคลินิก หรือ โรงพยาบาลสัตว์"
            :options="$vet_list"
            option-label="name"
            option-value="id"
            wire:model.defer="user"
            /> -->
    @endif

    <x-input class="py-4" type="password" label="รหัสผ่าน" placeholder="รหัสผ่าน" wire:model.defer="password" />
    <div class="py-4">
        <x-checkbox label="จดจำรหัสผ่านของฉันเอาไว้" wire:model.defer="remember_me" />
    </div>

    <x-button class="my-4" lg right-icon="chevron-right" primary
                wire:click="login" type="button" label="login" />

</div>
