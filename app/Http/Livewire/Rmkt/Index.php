<?php

namespace App\Http\Livewire\Rmkt;

use App\Models\Client;
use App\Models\rmkt_client;
use App\Models\Vet;
use Livewire\Component;

class Index extends Component
{
    public $step, $phone,$currentVet;
    public $otp_code;
    public $offer_1,$offer_2,$offer_3;
    public $client_data;
    public $vet,$vetall;
    public $vet_province,$vet_city,$vet_area,$vet_id;
    public $selected_vet_province,$selected_vet_city,$selected_vet_area,$selected_vet_text;
    public $readyToLoad = false;
    public function mount($phone=null){
        $this->phone = $phone;
        if($phone == null){
            $this->step = 0;
        }else{
            $this->loadclientdata();
            $this->next(2);
        }
        
        
        // $this->phone=000;
        // dd($this->loadclientdata());
    }
    public function loadclientdata(){
        $this->client_data = Client::firstWhere('phone',$this->phone);
        $this->vet_id = $this->client_data->vet_id;
        $this->next(3);
        // dd($this->client_data);
    }
    public function updateVet(){
        $this->currentVet=Vet::find($this->vet_id);
        // $this->loadclientdata();
        // dd($this->client_data,$this->vet_id);
        $this->next(3);
    }
    public function savermktdata(){
        $rmkt=rmkt_client::updateOrCreate([
            'client_id'=>$this->client_data->id,
            'active_status'=>null
        ],[
            'vet_id'=>$this->vet_id
        ]);
        $this->next(5);
    }
    public function loadAddr(){
        $this->readyToLoad = true;
        $this->vet = Vet::all();
        $this->vet_province = Vet::orderBy('vet_province','asc')->distinct('vet_province')->pluck('vet_province');

    }
    public function updatedSelectedVetProvince($selected_vet_province){
        $this->vetall = Vet::all();
        $this->vet_city =$this->vetall->where('vet_province',$selected_vet_province)->unique('vet_city');
        $this->vet=$this->vetall->where('vet_province',$selected_vet_province);
        $this->selected_vet_city=null;
        $this->selected_vet_area=null;
        
    }
    public function updatedSelectedVetCity($selected_vet_city){
        $this->vet_area =$this->vetall->where('vet_city',$selected_vet_city)->unique('vet_area');
        $this->vet=$this->vetall->where('vet_city',$selected_vet_city);
        $this->selected_vet_area=null;
    }
    public function updatedSelectedVetText($selected_vet_text){
        $this->vet=$this->vetall->where('vet_name',"%{$selected_vet_text}%");
    }

    public function render()
    {
        /* if($this->step==3){
            $this->loadclientdata();
        } */
        return view('livewire.rmkt.index')->layout('layouts.guest');
    }

    public function next($loc=null){
        $this->step=$loc??$this->step+1;
        // dd($this->step);
    }
}
