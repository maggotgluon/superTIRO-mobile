<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use App\Models\Vet as ModelsVet;
use Livewire\Component;
use Livewire\WithPagination;

class Vet extends Component
{
    use WithPagination;
    
    public $current_vet,$current_client;
    public $vet_id='';
    public $sort_icon=[
        'client_code'=>'',
        'updated_at'=>'',
        'name'=>'',
        'active_status'=>''
    ];

    public $search='',$order='client_code',$sort='asc';
    protected $queryString = [
        'search'=> ['except' => ''],
        'order'=> ['except' => 'client_code'],
        'sort'
    ];
    
    public function mount(){
        $this->current_vet = ModelsVet::find($this->vet_id);
        $this->current_client = Client::where('vet_id',$this->vet_id)->get();
    }
    public function order($order){
        $this->sort_icon=[
            'client_code'=>'',
            'updated_at'=>'',
            'name'=>'',
            'active_status'=>''
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

    public function render()
    {
        // dd(Client::where('vet_id',$this->vet_id)->paginate(10));
        return view('livewire.admin.vet',[
            'clients'=> Client::where('vet_id',$this->vet_id)
                ->orderBy($this->order,$this->sort)
                ->paginate(10)
        ]);
    }
}
