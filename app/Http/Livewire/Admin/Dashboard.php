<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use App\Models\ClientInfo;
use App\Models\Vet;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $all_vet, $all_client,$client,$client_info;

    public $search='',$order='id',$sort='asc';

    public $sort_icon=[
        'id'=>'',
        'updated_at'=>'',
        'name'=>'',
        'active_status'=>'',
    ];

    protected $queryString = [
        'search'=> ['except' => ''],
        'order'=> ['except' => 'id'],
        'sort'
    ];
    
    public function order($order){
        $this->sort_icon=[
            'id'=>'',
            'updated_at'=>'',
            'name'=>'',
            'active_status'=>'',
        ];
        // dd($this->order == $order);
        if($this->order == $order && $this->sort=='asc'){
            $this->sort='desc';
        }else {
            $this->sort='asc';
        }
        // dd($this->sort);
        $sort_icon = $this->sort=='desc'?'sort-descending':'sort-ascending';
        $this->order = $order;
        $this->sort_icon[$order] = $sort_icon;
        $this->resetPage();
    }

    public function mount(){
        // $this->all_vet = Vet::all();

        // $this->client_info = ClientInfo::all();
        // $this->all_client = Client::all();
    }
    public function render()
    {
        // $this->client = Client::orderBy($this->order,$this->sort);
        $client = Client::orderBy($this->order,$this->sort)->paginate(10);

        foreach($client as $k=>$c){
            $c->vet_id = $c->vet->vet_name;
            $c->vet_regis = $c->vet->client->count();
            $c->vet_total_activated = $c->vet->client->where('active_status','activated')->count();
            $c->vet_total_pending = $c->vet->client->where('active_status','pending')->count();
            $c->vet_total_await = $c->vet->client->where('active_status','await')->count();
            // dd($k,$c);
        }
        // dd(getType($client),getType($this->client));
        return view('livewire.admin.dashboard',[
            // 'clients'=>Client::orderBy($this->order,$this->sort)->paginate(10)]
            'clients'=>$client]
        );
    }
}
