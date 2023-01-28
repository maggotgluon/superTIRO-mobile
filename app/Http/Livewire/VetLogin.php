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
    public $user,$password,$remember_me;

    public function mount(){
        // $user = $this->user;
    }
    public function render()
    {
        return view('livewire.vet-login');
    }

    public function login(){
        // auth

        // $login = User::find()
        // dd(User::find(1));// vet::find(10000341)->user()->id);
        $username = vet::find($this->user)->user_id;
        $login = Auth::attempt(['id'=>$username,'password'=>$this->password] , $this->remember_me );
        // dd($login);
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
