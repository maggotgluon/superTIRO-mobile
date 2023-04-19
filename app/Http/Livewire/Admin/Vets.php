<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use App\Models\Vet;
use Livewire\Component;
use Livewire\WithPagination;

class Vets extends Component
{
    use WithPagination;

    public $all_vet, $all_client;
    
    public function mount(){
        $this->all_vet = Vet::all();
        $this->all_client = Client::all();;
    }
    
    public function render()
    {
        return view('livewire.admin.vets',['vets'=>Vet::paginate(10)]);
    }
}
