<div>
    <!-- <x-input label="ชื่อคลีนิก หรือ โรงพยาบาลสัตว์" wire:model="user" /> -->
    
    
    
    <x-select
    label="ชื่อคลีนิก หรือ โรงพยาบาลสัตว์"
    placeholder="ชื่อคลีนิก หรือ โรงพยาบาลสัตว์"
    :options="$vet_list"
    option-label="name"
    option-value="id"
    wire:model.defer="user"
    />

    <x-input type="password" label="รหัสผ่าน" placeholder="รหัสผ่าน" wire:model.defer="password" />

    <x-checkbox label="จดจำรหัสผ่านของฉันเอาไว้" wire:model.defer="remember_me" />

    <x-button lg right-icon="chevron-right" primary
                wire:click="login" type="button" label="login" />

</div>
