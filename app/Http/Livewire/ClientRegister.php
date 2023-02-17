<?php

namespace App\Http\Livewire;

use App\Jobs\SendEmail;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Vet;
use Illuminate\Support\Str;

class ClientRegister extends Component
{
    
    public $validate_test=true;
    public Client $client;
    public $vet,$vetall;
    public $vet_province,$vet_city,$vet_area,$vet_id;
    public $selected_vet_province,$selected_vet_city,$selected_vet_area,$selected_vet_text;

    public $currentStep = 1, $status = 1;
    public $firstname, $lastname, $phone,$email,$consent,$client_id;
    public $pet_name,$pet_breed,$pet_weight,$pet_age_month,$pet_age_year;
    public $successMessage = '';
    public $error;
    public $otp=array() ,$code;


    protected $messages = [
        'email.required' => 'จำเป็นต้องระบุ อีเมลล์',
        'email.email' => 'กรุณากรอก อีเมล์ ที่ถูกต้อง',
        'email.unique' => 'อีเมล์ นี้ลงทะเบียนรับสิทธิ์แล้ว',
        'phone.required' => 'จำเป็นต้องระบุ หมายเลขโทรศัพท์',
        'phone.unique' => 'หมายเลขโทรศัพท์ นี้ลงทะเบียนรับสิทธิ์แล้ว',
    ];

    public bool $blurModal = true;

    public function mount()
    {
        // $this->confirmation();
        $this->validate_test = env('TWILIO', false);
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
            'phone' => ['required', 'numeric', 'unique:'.Client::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Client::class],
            'consent' => ['required','bool']
        ]);

        // dd($this->email,$this->firstname.' '.$this->lastname);
        if($this->validate_test){
            $this->sendCode();
        }

        $this->currentStep = 1.5;
        
        if($this->status=='pending'){
        }
    }

    public function varifyOTP(){

        // $this->code = implode('',$this->otp);
        
        if($this->validate_test){
            $result = $this->verifyCode($this->code);
            if($this->status=="approved" || $result){
                $this->currentStep = 2;
            }else{
                $this->status = 'error';
            }
        }else{
            $this->currentStep = 2;
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
            'pet_weight' => 'required',
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
            'client_code'=>0,
            'name'=>$this->firstname.' '.$this->lastname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'phoneIsVerified'=>$this->code,
            'pet_name'=>$this->pet_name,
            'pet_breed'=>$this->pet_breed,
            'pet_weight'=>$this->pet_weight,
            'pet_age_month'=>$this->pet_age_month,
            'pet_age_year'=>$this->pet_age_year,
            'vet_id'=>$this->vet_id,
        ]);
        $client->client_code = 'TRIO'.Str::padLeft($client->id, 5, '0');
        $client->save();

        $this->confirmation();

        redirect( route('client.ticket',['phone'=>$this->phone]) );
        $this->currentStep = 4;
    }
    public function confirmation(){

        $details = [
            'email' => $this->email,
            'phone' => $this->phone,
            'pet_name' => $this->pet_name,
            'vet_name' => Vet::find($this->vet_id)->vet_name,
            'name' => $this->firstname.' '.$this->lastname,
        ];
        // $details = [
        //     'email' => 'maggotgluon@gmail.com',
        //     'phone' => '0809166690',
        //     'pet_weight' => 'pet_weight',
        //     'vet_name' => 'vet_id',
        //     'name' => 'firstname'.' '.'lastname',
        // ];
        SendEmail::dispatch($details);

        $body_sms = 'ยืนยันลงทะเบียนสำเร็จ ใช้สิทธิ์คลิก supertrio.app.mag.codes/client/login';

        try {
            $accountSid = getenv("TWILIO_SID");
            $authToken = getenv("TWILIO_AUTH_TOKEN");
            $twilioNumber = getenv("TWILIO_FROM");
            // dd($accountSid,$authToken);
            $twilio = resolve('TwilioClient');
            // $client = new Client($accountSid, $authToken);
            
            $twilio->messages->create(
                '+66' . str_replace('-', '', $details['phone']) , [
                'from' => $twilioNumber,
                'body' => $body_sms
            ]);
 
            return back()
            ->with('success','Sms has been successfully sent.');
 
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()
            ->with('error', $e->getMessage());
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function activateClient()
    {
        redirect( route('client.ticket',['phone'=>$this->phone]) );

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
        $this->pet_weight="";
        $this->pet_age_month="";
        $this->pet_age_year="";
        $this->vet_id="";
        $this->status = 1;
    }

    public function sendCode()
    {
        $twilio = resolve('TwilioClient');
        
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
        $twilio = resolve('TwilioClient');
        
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
        $this->consent = 1;
        $this->currentStep =1.25;
    }

}
