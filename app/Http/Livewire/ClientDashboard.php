<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ClientDashboard extends Component
{
    public $client;
    
    public $firstname, $lastname, $phone,$email,$consent;
    public $pet_name,$pet_breed,$pet_weigth,$pet_age_month,$pet_age_year;
    
    // public Client $client;
    public $vet,$vetall;
    public $vet_province,$vet_city,$vet_area,$vet_id;
    public $selected_vet_province,$selected_vet_city,$selected_vet_area,$selected_vet_text;

    // protected $listeners = ['clientLogin'];

    public function mount()
    {
        $this->client = \App\Models\Client::where('phone',$this->phone)->first();

    }

    public function clientLogin($client_id)
    {
        dd($client_id);
        // here u have the id in your other component. 
    }
    public function render()
    {
        return view('livewire.client-dashboard');
    }
}
