<?php

namespace App\Http\Livewire\Demo;

use Livewire\Component;

class Page extends Component
{
    public $offer_1,$offer_2,$offer_3;
    public $month,$input_vet_id,$input_vet_id_confirmation;
    
    protected $messages = [
        'input_vet_id.confirmed'=>'รหัสไม่ถูกต้อง',
        'input_vet_id.required'=>'กรุณาระบุ หรือสอบถามจากสถานพยาบาลที่เลือก',
        'offer_1.required' => 'เลือกอย่างน้อย 1 ตัวเลือก',
        'offer_2.required' => 'เลือกอย่างน้อย 1 ตัวเลือก',
        'offer_3.required' => 'เลือกอย่างน้อย 1 ตัวเลือก',
        'month.required_if' => 'กรุณาระบุจำนวนเดือน',
    ];
    protected $rules = [
        'input_vet_id' => 'required|confirmed',
        'offer_1' => 'exclude_if:offer_2,true|exclude_if:offer_3,true|required',
        'offer_2' => 'exclude_if:offer_1,true|exclude_if:offer_3,true|required',
        'offer_3' => 'exclude_if:offer_1,true|exclude_if:offer_2,true|required',
        'month' => 'required_if:offer_3,true'
    ];

    public function mount(){
        $this->input_vet_id_confirmation='123';
    }
    public function next(){
        if($this->offer_3 == null){
            $this->month=null;
        }
        $validatedData = $this->validate();

        // dd($validatedData);

    }

    public function render()
    {
        return view('livewire.demo.page');
    }
}
