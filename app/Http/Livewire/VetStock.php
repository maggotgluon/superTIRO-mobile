<?php

namespace App\Http\Livewire;

use App\Models\Vet;
use Livewire\Component;

class VetStock extends Component
{
    public $vets;
    public function mount()
    {
        $this->vets = Vet::all();


    }

    public function render()
    {
        return view('livewire.vet-stock');
    }
}
