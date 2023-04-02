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

    public function exportCSV(){

        $fileName = 'client.csv';
        $Clients = Client::all();
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('code', 'name', 'email', 'phone', 'status', 'activate date', 'vet name' ,'Pet name', 'Pet bread', 'Pet Weight', 'Pet Age','basic offer','extra offer');

        $callback = function() use($Clients, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
    
            foreach ($Clients as $Client) {
                $row['code']  = $Client->client_code;
                $row['name']    = $Client->name;
                $row['email']    = $Client->email;
                $row['phone']  = $Client->phone;
                $row['status']  = $Client->active_status;
                $row['activate_date']  = $Client->active_date??"-";
                $row['vet']  = Vet::find($Client->vet_id)->vet_name??$Client->vet_id;
                
                $option = explode("-", $Client->phoneIsVerified);
                // dd(str_contains($option[1],'standard'),str_contains($option[1],'extra'));
                if( is_array($option) ){
                    $row['offerBasic'] = count($option)>1?str_contains($option[1],'standard'):"";
                    $row['offerExtra'] = count($option)>1?str_contains($option[1],'extra'):"";
                }
    
                $row['petName']  = $Client->pet_name;
                $row['petBreed']  = $Client->pet_breed;
                $row['petWeight']  = $Client->pet_weight;
                $row['petAge']  = $Client->pet_age_month.' Year '.$Client->pet_age_month.' Month';
    
                fputcsv($file, array($row['code'], $row['name'], $row['email'], $row['phone'], $row['status'], $row['activate_date'], $row['vet'], $row['petName'],$row['petBreed'],$row['petWeight'],$row['petAge'],$row['offerBasic'],$row['offerExtra']));
            }
    
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
