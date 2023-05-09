<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\ClientInfo;
use Illuminate\Support\Arr;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ClientDashboard extends Component
{
    public Client $client;

    public $phone;
    public $input_vet_id,$client_code;
    public $currentStep=1,$status=0;
    public $timeleft=0,$startTime,$endTime;
    public $leftMin,$leftSec;
    public $offer=[];

    public $count=1 ;

    public function increment(){
        $this->count+=1;
    }
    public function decrement(){
        $this->timeleft-=1;
        $this->leftMin=floor($this->timeleft/60);
        $this->leftSec=$this->timeleft - ($this->leftMin*60);
        
        if($this->client->active_status==='activated'){
            $this->go(6);
        }else if($this->timeleft==0){
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
        $this->client = Client::where('phone',$this->phone)->first();
        $this->client_code = $this->client->client_code;
        
        switch ($this->client->active_status) {
            case 'await':
                $this->go(4);
                break;
            case 'expired':
                $this->go(5);
                break;
            case 'activated':
                $this->go(6);
                break;            
            default:
                break;
        }
        // dd($this->client);
        if($this->client->active_date){
            $this->countdown();
        }
    }

    public function render()
    {

        switch ($this->client->active_status) {
            case 'await':
                $this->go(4);
                break;
            case 'expired':
                $this->go(5);
                break;
            case 'activated':
                $this->go(6);
                break;            
            default:
                break;
        }
        return view('livewire.client-dashboard');
    }
    
    public function verifyVet()
    {
        // dd($this->client->active_date);

        $validatedData = $this->validate([
            'offer' => ['required', 'array']
        ]);
        // active_status

        if($this->input_vet_id == $this->client->vet->stock_id){

            if(array_search('standard',$this->offer) ) {

                $this->client->option_1=true;
                $this->client->save();
                
            }
            if(array_search('extra_1',$this->offer) ) {

                $this->client->option_2=true;
                $this->client->save();
                ;
            }
            if(array_search('extra_2',$this->offer) ) {

                $this->client->option_3=true;
                $this->client->save();
                
            }
            //dd(array_search('standard',$this->offer),array_search('extra_1',$this->offer),array_search('extra_2',$this->offer));            
            //update record
            $this->client->active_date = now();
            $this->client->active_status = 'activated';
            // $this->client->phoneIsVerified .= '-'.implode(",",$this->offer);
            $this->client->save();

            // $info = new ClientInfo();
            // $info->client_id = 48;


            $this->go($this->currentStep+1);
            $this->countdown();
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
            $this->client->active_status = 'activated';
            $this->client->save();
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
