<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Vet;

class ClientRegister extends Component
{

    public Client $client;
    public $vet,$vetall;
    public $vet_province,$vet_city,$vet_area,$vet_id;
    public $selected_vet_province,$selected_vet_city,$selected_vet_area,$selected_vet_text;

    public $currentStep = 1, $status = 1;
    public $firstname, $lastname, $phone,$email,$consent;
    public $pet_name,$pet_breed,$pet_weigth,$pet_age_month,$pet_age_year;
    public $successMessage = '';
    public $error;
    public $otp=array() ,$code;


    public bool $blurModal = true;

    public function mount()
    {
        $this->vetall = Vet::all();
        $this->vet = Vet::all();
        $this->vet_province = $this->vetall->unique('vet_province');
    }

    public function updatedSelectedVetProvince($selected_vet_province){
        $this->vet_city =$this->vetall->where('vet_province',$selected_vet_province)->unique('vet_city');
        $this->vet=$this->vetall->where('vet_province',$selected_vet_province);
        $this->selected_vet_city=null;
        $this->selected_vet_area=null;
    }
    public function updatedSelectedVetCity($selected_vet_city){
        $this->vet_area =$this->vetall->where('vet_city',$selected_vet_city)->unique('vet_area');
        $this->vet=$this->vetall->where('vet_city',$selected_vet_city);
        $this->selected_vet_area=null;
    }
    public function updatedSelectedVetText($selected_vet_text){
        $this->vet=$this->vetall->where('vet_name',"%{$selected_vet_text}%");
    }

    public function render()
    {
        return view('livewire.client-register');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function firstStepSubmit()
    {
        // $this->consent = $this->consent==1?true:false;
        $validatedData = $this->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],//, 'unique:'.Client::class],
            'email' => ['required', 'string', 'email', 'max:255'],//, 'unique:'.Client::class],
            'consent' => ['required','bool']
        ]);
        $this->sendCode();
        $this->currentStep = 1.5;
        if($this->status=='pending'){
        }
    }

    public function varifyOTP(){

        $this->code = implode('',$this->otp);
        $this->currentStep = 2;
        $result = $this->verifyCode(implode('',$this->otp));
        // $this->successMessage = $result;

        if($this->status=="approved" || $result){
            $this->currentStep = 2;
        }else{
            $this->status = 'error';
        }

    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'pet_name' => 'required',
            'pet_breed' => 'required',
            'pet_weigth' => 'required',
            'pet_age_month' => 'required',
            'pet_age_year' => 'required',
        ]);

        $this->currentStep = 3;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function thirdStepSubmit()
    {
        $validatedData = $this->validate([
            'vet_id' => 'required'
        ]);

        $client = Client::create([
            'name'=>$this->firstname.' '.$this->lastname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'phoneIsVerified'=>true,
            'pet_name'=>$this->pet_name,
            'pet_breed'=>$this->pet_breed,
            'pet_weight'=>$this->pet_weigth,
            'pet_age_month'=>$this->pet_age_month,
            'pet_age_year'=>$this->pet_age_year,
            'vet_id'=>$this->vet_id,
        ]);
        dd($client);
        $this->currentStep = 4;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForm()
    {
        // Product::create([
        //     'name' => $this->name,
        //     'amount' => $this->amount,
        //     'description' => $this->description,
        //     'stock' => $this->stock,
        //     'status' => $this->status,
        // ]);

        $this->successMessage = 'Product Created Successfully.';

        $this->clearForm();

        $this->currentStep = 1;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearForm()
    {
        $this->firstname="";
        $this->lastname="";
        $this->email="";
        $this->phone="";
        $this->email="";
        $this->pet_name="";
        $this->pet_breed="";
        $this->pet_weigth="";
        $this->pet_age_month="";
        $this->pet_age_year="";
        $this->vet_id="";
        $this->status = 1;
    }

    public function sendCode()
    {
        $twilio = resolve('TwilioClient');
        // dd($this->phone, $twilio);
        $verification = $twilio
            ->verify
            ->v2
            ->services(getenv('TWILIO_VERIFY_SID'))
            ->verifications
            ->create('+66' . str_replace('-', '', $this->phone), "sms");

        $this->status = $verification->status;
    }

    public function verifyCode()
    {
        // return;
        $twilio = resolve('TwilioClient');
        // dd($this->code,$twilio );
        try {
            $verification_check = $twilio
                ->verify
                ->v2
                ->services(getenv('TWILIO_VERIFY_SID'))
                ->verificationChecks
                ->create([
                    "code" => $this->code, // code
                    "to" => '+66' . str_replace('-', '', $this->phone)
                    ]);

        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;

        }
        if ($verification_check->valid == false) {
            $this->error = 'That code is invalid, please try again.';
        }else{
            $this->error = '';
            $this->status = $verification_check->status;
        }
        return $verification_check->valid;


    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function openConsent()
    {
        $this->currentStep =1.25;
    }

}
