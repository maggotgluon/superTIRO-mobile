<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Webview extends Component
{
    public $data=[];
    public function mount(){
        
        $this->data['REQUEST_TIME'] = $_SERVER['REQUEST_TIME']??'-';
        $this->data['HTTP_X_REQUESTED_WITH'] = $_SERVER["HTTP_X_REQUESTED_WITH"]??'-';
        $this->data['HTTP_USER_AGENT'] = $_SERVER["HTTP_USER_AGENT"]??'-';
        $this->data['HTTP_SEC_CH_UA'] = $_SERVER["HTTP_SEC_CH_UA"]??'-';
        $this->data['HTTP_SEC_CH_UA_MOBILE'] = $_SERVER["HTTP_SEC_CH_UA_MOBILE"]??'-';
        $this->data['HTTP_SEC_CH_UA_PLATFORM'] = $_SERVER["HTTP_SEC_CH_UA_PLATFORM"]??'-';

    }
    public function render()
    {
        return view('livewire.webview');
    }
}
