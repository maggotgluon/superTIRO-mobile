<div class="text-content-dark relative min-h-[50vh]">
<div class="text-center absolute inset-0 z-50" wire:loading.delay.longer>
        <img class="m-auto" src="{{url('/loading.gif')}}"/>
    </div>


    <div class="row setup-content  min-h-[70vh] flex flex-col" id="step-4">
        <h3 class="text-center text-xl my-4 pt-4 font-bold text-primary-blue"> กรุณากรอกรหัสคลินิก <br>หรือ โรงพยาบาลสัตว์ </h3>
        <p class="text-center mb-8">
            (สอบถามที่พนักงานของคลินิก)
        </p>
        
        <x-input wire:model="input_vet_id" label="รหัสคลินิก หรือ โรงพยาบาลสัตว์" placeholder="รหัสคลินิก หรือ โรงพยาบาลสัตว์"/>
        <div class="mt-2">
            <span class="p-2 block"><x-checkbox lg class="rounded-full" label="รับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO"
                    id="standard"    wire:model.lazy="offer_1" /></span>
            <span class="p-2 block"><x-checkbox lg class="rounded-full" label="รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 1 เดือน"
                    id="extra_1"    wire:model.lazy="offer_2" /></span>
            <span class="p-2 block"><x-checkbox lg class="rounded-full" label="รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 3 เดือน"
                    id="extra_2"    wire:model.lazy="offer_3" /></span>
                    
            <span class="p-2 {{$offer_3?'block':'hidden'}}" >
                <x-native-select
                    wire:model.lazy="month"
                    label="จำนวนเดือน"
                    placeholder="เลือกจำนวนเดือน"
                    :options="[3,6,9,12,15,18,21,24,27,30,33,36]"
                />
            </span>
        </div>
        <x-button wire:click="next" label="next" />
</div>
