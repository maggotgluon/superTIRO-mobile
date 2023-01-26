<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ClientDashboard extends Component
{
    public $client;

    public $phone;
    public $input_vet_id,$client_code;
    public $currentStep=1,$status=0;
    public $timeleft=0,$startTime,$endTime;
    public $leftMin,$leftSec;

    public $count=1 ;

    public function increment(){
        $this->count+=1;
    }
    public function decrement(){
        $this->timeleft-=1;
        $this->leftMin=floor($this->timeleft/60);
        $this->leftSec=$this->timeleft - ($this->leftMin*60);
        if($this->timeleft==0){
            $this->go(5);
        }
    }
    
    // public $firstname, $lastname, $phone,$email,$consent;
    // public $pet_name,$pet_breed,$pet_weight,$pet_age_month,$pet_age_year;
    
    // public Client $client;
    // public $vet,$vetall;
    // public $vet_province,$vet_city,$vet_area,$vet_id;
    // public $selected_vet_province,$selected_vet_city,$selected_vet_area,$selected_vet_text;

    // protected $listeners = ['clientLogin'];

    public function mount()
    {
        $this->client = \App\Models\Client::where('phone',$this->phone)->first();
        $this->client_code = 'TRIO'.Str::padLeft($this->client->id, 5, '0');
        // dd($this->client);
        if($this->client->active_date){
            $this->countdown();
        }
    }

    public function render()
    {
        return view('livewire.client-dashboard');
    }
    
    public function verifyVet()
    {
        // dd($this->client->active_date);
        // active_status
        if($this->input_vet_id == $this->client->vet_id){
            //update record
            $this->client->active_date = now();
            $this->client->active_status = now(); //'await';
            $this->client->save();
            $this->countdown();
            $this->go($this->currentStep+1);
        }else{
            $this->status=-1;
        }
    }
    public function countdown(){
        $this->startTime = Carbon::create($this->client->active_date);
        $this->endTime = Carbon::create($this->client->active_date)->addMinutes(15);
        $this->timeleft=Carbon::now()->diffInSeconds($this->endTime);
        if($this->endTime->isPast()){
            $this->go(5);
        }else{
            $this->leftMin=$this->timeleft/60;
            $this->leftSec=$this->timeleft-($this->leftMin*60);
            $this->go(4);
        }
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function go($step)
    {
        $this->currentStep = $step;
    }
}
