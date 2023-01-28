<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\User;
use App\Models\Vet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class VetDashboard extends Component
{
    public User $user;
    public $vet;
    public $clients;
    
    public function mount(){
        $this->user = Auth::user();
        $this->vet = Vet::where('user_id',Auth::user()->id)->first();
        $this->clients = $this->vet->client;
    }
    public function render()
    {
        // dd($this->user,$this->vet);
        return view('livewire.vet-dashboard');
    }
    public function filter($filter){
        $this->clients = $this->vet->client;
        $this->clients = $this->clients->where('active_status',$filter);
    }
    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
    public function humanTime($date_time){
        // dd($date_time);
        $date_time=Carbon::parse($date_time);

        return $date_time;
    }
    public function approvedClient($client_id){
        $client = Client::find($client_id);
        $client->active_status = 'activated';
        $client->save();
        $this->redirect('/dashboard');
        $this->render();
        // dd($client);

    }
    public function revokeClient($client_id){
        // dd($client_id);
        $client = Client::find($client_id);
        $client->active_date=null;
        $client->active_status = 'pending';
        $client->save();
        $this->redirect('/dashboard');
        $this->render();
    }
}
