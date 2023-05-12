<?php

namespace App\Http\Livewire;

use App\Models\Vet;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Admin extends Component
{
    public $vet_list,$VetSelect;
    // public $search = '' ,$page = 'dashboard';
 
    // protected $queryString = [
    //     'search'=> ['except' => ''] ,
    //     'page'=> ['except' => 'dashboard',''] ,
    // ];

    public function mount(){
        // $vet_all = Vet::lazy();
        // dd($vet_all);
        foreach (Vet::lazy() as $index => $vet) {
            $this->vet_list[$index]['id']=$vet->id;
            $this->vet_list[$index]['name']=$vet->vet_name;
            $this->vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
        }
        
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/admin');
    }
    public function updatedVetSelect(){
        return redirect(route('admin.vetSingle',['vet_id'=>$this->VetSelect])) ;
    }
    public function render()
    {
        return view('livewire.admin');
    }
}
