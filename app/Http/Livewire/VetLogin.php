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

class VetLogin extends Component
{
    public $vet_list,$vet_all;
    public $user_list;
    public $user,$password,$remember_me;

    public function mount(){
        $this->user_list = User::all();
        $this->vet_all = Vet::all();

        foreach ($this->vet_all as $index => $vet) {
            $this->vet_list[$index]['id']=$vet->id;
            $this->vet_list[$index]['name']=$vet->vet_name;
            $this->vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
        }
    }
    public function render()
    {
        // dd($this->vet_list);
        return view('livewire.vet-login');
    }

    public function login(){
        // auth

        // $login = User::find()
        // dd(User::find(1));// vet::find(10000341)->user()->id);
        $username = vet::find($this->user)->user_id;
        $password = Hash::make($this->password);
        $login = Auth::attempt(['id'=>$username,'password'=>$password] , $this->remember_me );
        //dd($login,$username);
//         $user = user::find($username);
//         Auth::login($user);
//         return redirect(RouteServiceProvider::HOME);
        if( $login ){
            $user = user::find($username);
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        }else{
            
        }
        // dd( $this->user ,Auth::attempt(['id'=>$this->user,'password'=>$this->password] , $this->remember_me));
        // if (! Auth::attempt($this->only('id', 'password'), $this->boolean('remember'))) {
            // RateLimiter::hit($this->throttleKey());

            // throw ValidationException::withMessages([
                // 'id' => trans('auth.failed'),
            // ]);
        // }

    }

}
