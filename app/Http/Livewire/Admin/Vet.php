<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use App\Models\ClientInfo;
use App\Models\stock;
use App\Models\Vet as ModelsVet;
use App\Models\VetInfo;
use Livewire\Component;
use Livewire\WithPagination;

class Vet extends Component
{
    use WithPagination;
    
    public $current_vet,$current_client,$current_client_info;
    public $vet_id='';
    public $vet_list;
    public $sort_icon=[
        'client_code'=>'',
        'updated_at'=>'',
        'name'=>'',
        'active_status'=>''
    ];
    public $stock_adj;

    public $search='',$order='client_code',$sort='asc';
    
    protected $queryString = [
        'search'=> ['except' => ''],
        'order'=> ['except' => 'client_code'],
        'sort'
    ];
    
    public function mount($vet_id){
        $this->stock_adj = 0;
        $vets = ModelsVet::all();
        $this->current_vet = ModelsVet::find($vet_id);
        $this->current_client = Client::where('vet_id',$this->vet_id)->get();
        // dd($this->current_vet,$vet_id);
        // foreach ($vets as $index => $vet) {
        //     $this->vet_list[$index]['id']=$vet->id;
        //     $this->vet_list[$index]['name']=$vet->vet_name;
        //     $this->vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
        // }
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
    public function add_stock_adj(){ 
        $stock_adj = $this->stock_adj;

        if($stock_adj){
            $current = $this->current_vet->stock->total_stock;
            $adj = $this->current_vet->stock->stock_adj+1;
            // dd($current,$this->stock_adj,$adj);
            stock::updateOrCreate(
                ['id'=>$this->vet_id],
                ['total_stock'=>$current+$this->stock_adj,'stock_adj'=>$adj],
            );
        }else{
            return null;
        }

    }

    public function render()
    {
        
        // dd(Client::where('vet_id',$this->vet_id)->paginate(10));
        return view('livewire.admin.vet',[
            'clients'=> Client::where('vet_id',$this->vet_id)
                ->orderBy($this->order,$this->sort)
                ->paginate(10)
        ])->extends('layouts.app');
    }
}
