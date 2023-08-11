
<div class="text-content-dark relative min-h-[50vh]">
    <div class="text-center absolute inset-0 z-50 " wire:loading>
        <img class="m-auto" src="{{url('/loading.gif')}}"/>
    </div>
    {{-- no special link --}}
    @switch($step)
        @case(0)
            
    <div class="setup-content min-h-[70vh] flex flex-col transition-all {{$step==0? '' : 'hidden'}}" id="step-0">
        {{-- phone number input --}}
        <div class="mt-8 pb-2">
        <x-input label="กรุณากรอกเบอร์โทรศัพท์ ที่ท่านเคยลงทะเบียนไว้" wire:model.defer="phone"/>
        </div>

        <div class="py-2 text-center mt-auto " wire:loading.remove>
            
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl" 
            wire:click="next" type="button" label="ถัดไป" />
            
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>
            @break

        @case(1)
            
    <div class="setup-content min-h-[70vh] flex flex-col {{$step==1? '' : 'hidden'}}" id="step-1">
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl pb-2 font-bold"> ยืนยัน OTP </h3>
            <p class="text-center">
                เราได้ส่ง SMS ไปยังหมายเลข {{$phone}}
            </p>
        </div>
        <div class="single-input-container flex gap-2 my-8">
        <input wire:model.defer="otp_code" type="text" maxlength="6" inputmode="numeric"
            class=" text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" />
        </div>
        
        
        <div class="py-2 text-center mt-auto" wire:loading.remove>
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
            {{-- wire:click="varifyOTP" --}}
            wire:click="loadclientdata" type="button" label="ถัดไป" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>
        @break
        @case(2)
            {{-- rmkt special link --}}
    <div class="setup-content min-h-[70vh] flex flex-col transition-all {{$step==2? '' : 'hidden'}}" id="step-2">
        {{-- confirm data and privage --}}
        <div class="mt-8 pb-2">
        ถึงเวลาปกป้อง <br>
        <h3 class="text-xl pb-2 font-bold"> {{$client_data->pet_name??''}} </h3>
        จากปรสิตแล้ว<br>
        </div>
        <span class="text-sm">
        *กรุณากดรับสิทธิ์ เพื่อถึงรพ.สัตว์ที่ท่านต้องการรับบริการ
        </span>
        
        <div class="py-2 text-center mt-auto grid gap-2" wire:loading.remove>
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
            {{-- wire:click="varifyOTP" --}}
            wire:click="next(3)" type="button" label="รับสิทธิ์" />
            <x-button lg 
            {{-- right-icon="chevron-right"  --}}
            primary class="bg-gradient-to-br from-warning-600 to-negative-600 rounded-2xl"
            {{-- wire:click="varifyOTP" --}}
            wire:click="next(6)" type="button" label="เก็บสิทธิ์ไว้ก่อน" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
        {{-- show opt out button case from rmkt --}}
    </div>
            @break

        @case(3)
            
    <div class="setup-content min-h-[70vh] flex flex-col transition-all {{$step==3? '' : 'hidden'}}" id="step-3">
        {{-- opt in --}}
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl pb-2 font-bold">กรุณาตรวจสอบข้อมูลเพื่อยืนยันรับสิทธิ์</h3>
        
            <ul>
        <li>ชื่อ : {{$client_data->pet_name??''}}</li>
        <li>น้ำหนัก : {{$client_data->pet_weight??''}}</li>
        <li>อายุ : {{$client_data->pet_age_year??''}} ปี {{$client_data->pet_age_month??''}} เดือน</li>
        <li>รพ. : {{$currentVet->vet_name??$client_data->vet->vet_name}}</li>
            </ul>
        
        </div>
        <div class="flex justify-between py-2 text-center mt-auto" wire:loading.remove>
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
            {{-- wire:click="varifyOTP" --}}
            wire:click="savermktdata" type="button" label="ยืนยัน" />
            <x-button lg 
            {{-- right-icon="chevron-right"  --}}
            primary class="bg-gradient-to-br  from-warning-600 to-negative-600 rounded-2xl"
            {{-- wire:click="varifyOTP" --}}
            wire:click="next(4)" type="button" label="เปลี่ยนสถานที่รับสิทธิ์" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
        {{-- edit or confirm --}}
    </div>
        @break
        @case(4)
            
    <div class="setup-content min-h-[70vh] flex flex-col transition-all {{$step==4? '' : 'hidden'}}" id="step-4">
        
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl pb-2 font-bold">กรุณาเลือกสถานพยาบาลที่เข้ารับบริการ</h3>
        </div>
        <div class="mt-4" wire:init="loadAddr">
            @if ($vet_province!=null)
            <x-select
                label="จังหวัด"
                wire:model="selected_vet_province"
                placeholder="เลือกจังหวัด"
                :options="$vet_province"
                clearable=false
            />
            @endif
        </div>
        @if ($selected_vet_province!=null)
            <div class="mt-4">
                <x-native-select label="อำเภอ" placeholder="เลือกอำเภอ" :options="$vet_city" option-label="vet_city" option-value="vet_city" wire:model="selected_vet_city" /> 
            </div>
        @endif

        @if ($selected_vet_city!=null)
            <div class="mt-4">
                <x-native-select label="ตำบล" placeholder="เลือกตำบล" :options="$vet_area" option-label="vet_area" option-value="vet_area" wire:model="selected_vet_area" />
            </div>
        @endif

        @if ($vet!=null)
        <div class="mt-4 bg-primary-lite rounded-xl p-2 h-[25vh] overflow-y-scroll soft-scrollbar">
            @foreach ( $vet as $vetlist )
            <div class="mb-4">
                <x-radio id="{{$vetlist->user_id}}" label="{{$vetlist->user_id}} {{$vetlist->vet_name}}" value="{{$vetlist->id}}" wire:model.lazy="vet_id" />
            </div>
            @endforeach
        </div>
        @endif
        {{-- {{$vet_id??'-'}} --}}

        {{-- edit page --}}
        <div class="flex justify-between py-2 text-center mt-auto" wire:loading.remove>
            <x-button lg 
            {{-- right-icon="chevron-right"  --}}
            primary class="bg-gradient-to-br  from-warning-600 to-negative-600 rounded-2xl"
            {{-- wire:click="varifyOTP" --}}
            wire:click="next(3)" type="button" label="ยกเลิก" />

            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
        {{-- wire:click="varifyOTP" --}}
        wire:click="updateVet" type="button" label="ยืนยัน" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>
            @break
        @case(5)
            
    <div class="setup-content min-h-[70vh] flex flex-col transition-all {{$step==5? '' : 'hidden'}}" id="step-5">
        {{-- confirm page --}}
        เลือก option 
        กรอกรหัส รพ
        <h3 class="text-center text-xl my-4 pt-4 font-bold text-primary-blue"> กรุณากรอกรหัสคลินิก <br>หรือ โรงพยาบาลสัตว์ </h3>
        <p class="text-center mb-8">
            (สอบถามที่พนักงานของคลินิก)
        </p>
        <x-input wire:model="vet_id" label="รหัสคลินิก หรือ โรงพยาบาลสัตว์" placeholder="รหัสคลินิก หรือ โรงพยาบาลสัตว์"/>
        
        <span class="p-2 block"><x-checkbox lg class="rounded-full" label="รับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO"
            id="standard"    wire:model.lazy="offer_1" /></span>
        <span class="p-2 block"><x-checkbox lg class="rounded-full" label="รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 1 เดือน"
            id="extra_1"    wire:model.lazy="offer_2" /></span>
        <span class="p-2 block"><x-checkbox lg class="rounded-full" value=3 label="รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม {{ $offer_3?$offer_3:'3' }} เดือน"
            id="extra_2"    wire:model.lazy="offer_3" /></span>


            <span class="p-2 block">
                <x-native-select label="ระยะเวลา" placeholder="เลือกระยะเวลา" 
                    :options="[
                        ['name' => '3 เดือน',  'id' => 3],
                        ['name' => '6 เดือน',  'id' => 6],
                        ['name' => '9 เดือน',  'id' => 9],
                        ['name' => '12 เดือน',  'id' => 12],
                        ['name' => '15 เดือน',  'id' => 15],
                        ['name' => '18 เดือน',  'id' => 18],
                        ['name' => '21 เดือน',  'id' => 21],
                        ['name' => '24 เดือน',  'id' => 24],
                        ['name' => '27 เดือน',  'id' => 27],
                        ['name' => '30 เดือน',  'id' => 30],
                        ]" 

                    option-label="name"
                    option-value="id"
                    wire:model="offer_3" />
            </span>
        
    </div>
            @break

        @case(6)
            
    <div class="setup-content min-h-[70vh] flex flex-col transition-all {{$step==6? '' : 'hidden'}}" id="step-6">
        {{-- opt out --}}
        <div class="my-auto pb-2 text-center">
        ท่านสามารถ กด Link เพื่อรับสิทธิ์ <br>
        จาก Email และ SMS<br> 
        ได้อีกครั้ง
        </div>
    </div>
            @break

        @case(7)
            
        @break
        @default
            
    @endswitch


   
    

    

    </div>

