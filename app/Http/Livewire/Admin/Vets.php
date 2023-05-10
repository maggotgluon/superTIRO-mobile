<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use App\Models\stock;
use App\Models\Vet;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Vets extends Component
{
    use WithPagination;

    public $stock;
    public $vet_list;
    
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
        $this->stock = stock::sum('total_stock');
        // $this->all_client = Client::all();
        $vets = vet::with('client')->with('stock')->get();

        foreach ($vets as $index => $vet) {
            $this->vet_list[$index]['id']=$vet->id;
            $this->vet_list[$index]['name']=$vet->vet_name;
            $this->vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
        }
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
        // $this->order 
        $vets=Vet::with('client')->with('stock')->orderBy($this->order,$this->sort)->paginate(50);
        // dd($vets[0]->stock->total_stock);
        foreach($vets as $k=>$v){
            $v->stocks = $v->stock->total_stock;
            $v->stocks_adj = $v->stock->stock_adj;
            $v->total_client = $v->client->count();
            $v->total_client_activated = $v->client->where('active_status','activated')->count();
            $v->total_client_pending = $v->client->where('active_status','pending')->count();
            $v->total_client_await = $v->client->where('active_status','await')->count();
        }

        // dd(Vet::with('vet_infos')->get());
        return view('livewire.admin.vets',[
            'vets'=>$vets,'total'=>$this->stock
        ])->extends('layouts.app');;
    }
}
