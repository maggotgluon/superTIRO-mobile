<div>
    <x-input label="ชื่อคลีนิก หรือ โรงพยาบาลสัตว์" wire:model="user" />
    <x-input type="password" label="รหัสผ่าน" placeholder="รหัสผ่าน" wire:model="password" />

    <x-checkbox label="จดจำรหัสผ่านของฉันเอาไว้" wire:model.defer="remember_me" />

    <x-button lg right-icon="chevron-right" primary
                wire:click="login" type="button" label="login" />

</div>
