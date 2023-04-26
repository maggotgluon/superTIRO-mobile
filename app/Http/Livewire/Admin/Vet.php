<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use App\Models\ClientInfo;
use App\Models\Vet as ModelsVet;
use App\Models\VetInfo;
use Livewire\Component;
use Livewire\WithPagination;

class Vet extends Component
{
    use WithPagination;
    
    public $current_vet,$current_client,$current_client_info;
    public $vet_id='';
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
    
    public function mount(){
        $this->current_client_info = collect();
        $this->stock_adj = 0;
        $this->current_vet = ModelsVet::find($this->vet_id);
        $this->current_client = Client::where('vet_id',$this->vet_id)->get();
        foreach ($this->current_client as $client) {
            foreach($client->info as $info){
                $this->current_client_info->push($info);
                // [$info->meta_name] += $info->meta_value;
            }
        }
        // dd($this->current_client_info->where('meta_name','selected_standard_option')->count());
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
            $current = $this->current_vet->info()->where('meta_name','stock')->first()->meta_value??0;
            $stock = VetInfo::updateOrCreate(
                ['vet_id'=>$this->vet_id,'meta_name'=>'stock','meta_type'=>'int'],
                ['meta_value'=>$stock_adj+$current],
            );
            $record = VetInfo::create(
                ['vet_id'=>$this->vet_id,'meta_name'=>'stock_adj','meta_type'=>'int','meta_value'=>$stock_adj],
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
        ]);
    }
}
