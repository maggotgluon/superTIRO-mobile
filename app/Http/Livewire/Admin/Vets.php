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
    
    public $search='',$order='id',$sort='asc';

    public $sort_icon=[
        'id'=>'',
        'vet_name'=>'',
    ];

    protected $queryString = [
        'search'=> ['except' => ''],
        'order'=> ['except' => 'id'],
        'sort'
    ];
    public function mount(){
        $this->all_vet = Vet::all();
        $this->all_client = Client::all();
    }
    
    public function order($order){
        $this->sort_icon=[
            'id'=>'',
            'vet_name'=>'',
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
        $vets=Vet::orderBy($this->order,$this->sort);

        return view('livewire.admin.vets',[
            'vets'=>$vets->paginate(10)
        ]);
    }
}
