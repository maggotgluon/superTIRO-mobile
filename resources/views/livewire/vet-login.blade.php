<div>
    <x-input label="email" wire:model="email" />
    <x-input type="password" label="password" wire:model="password" />

    <x-button lg right-icon="chevron-right" primary
                wire:click="firstStepSubmit" type="button" label="login" />

</div>
