<?php

namespace App\Http\Livewire;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\Vet;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Illuminate\Support\Facades\Hash;

class VetLogin extends Component
{
    public $vet_list,$vet_all;
    public $user_list;
    public $user,$password,$remember_me;
    public $adm,$adm_user;

    public function mount(){
        
    }
    public function render()
    {
        $this->user_list = User::all();
        $this->vet_all = Vet::all();
        // $this->adm=1;

        foreach ($this->vet_all as $index => $vet) {
            $this->vet_list[$index]['id']=$vet->id;
            $this->vet_list[$index]['name']=$vet->user_id.' '.$vet->vet_name;
            $this->vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
        }
        // dd($this->vet_list);
        return view('livewire.vet-login');
    }

    public function login(){
        // auth

        // $login = User::find()
        // dd(User::find(1));// vet::find(10000341)->user()->id);
        $password = $this->password;
        if($this->adm){
            $username = $this->adm_user;
            $login = Auth::attempt(['name'=>$username,'password'=>$password] , $this->remember_me );
        }else{
            $username = vet::find($this->user)->user_id;
            $login = Auth::attempt(['id'=>$username,'password'=>$password] , $this->remember_me );
            // dd($username,$password,$login);
        }

        // $user = user::find($username);
        // dd($login,$username,$user,$password,$this->user);
        //Auth::login($user);
        //return redirect(RouteServiceProvider::HOME);
        if( $login ){
            $user = user::find($username); //??user::where('name',$username)->first();
            // dd($login,$username,$password,Hash::make($password),$user);
            
            Auth::login($user);

            if(Auth::user()->name == 'admin'){
                return redirect(route('admin.dashboard'));    
            }
            return redirect(route('vet.ticket',$user->id));
        }else{
            $this->reset();
        }
        // dd( $this->user ,Auth::attempt(['id'=>$this->user,'password'=>$this->password] , $this->remember_me));
        

    }

}
