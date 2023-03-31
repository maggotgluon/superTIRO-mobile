<div class="py-6 min-h-[50vh]">
    <!-- <x-input label="ชื่อคลินิก หรือ โรงพยาบาลสัตว์" wire:model="user" /> -->
    
    
    
    <x-select class="py-4"
    label="ชื่อคลินิก หรือ โรงพยาบาลสัตว์"
    placeholder="ชื่อคลินิก หรือ โรงพยาบาลสัตว์"
    :options="$vet_list"
    option-label="name"
    option-value="id"
    wire:model.defer="user"
    />

    <x-input class="py-4" type="password" label="รหัสผ่าน" placeholder="รหัสผ่าน" wire:model.defer="password" />
    <div class="py-4">
        <x-checkbox label="จดจำรหัสผ่านของฉันเอาไว้" wire:model.defer="remember_me" />
    </div>

    <x-button class="my-4" lg right-icon="chevron-right" primary
                wire:click="login" type="button" label="login" />

</div>
