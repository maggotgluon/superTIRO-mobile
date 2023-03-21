<div class="text-content-dark">
    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 1 ? 'hidden' : '' }}" id="step-4">
        <h3 class="text-center text-xl my-4 p-4 font-bold text-white bg-primary-blue"> การลงทะเบียนเสร็จสมบูรณ์ </h3>
        <p class="text-center">
            ท่านได้รับสิทธิ์ รับคำปรึกษา <br>
            และเข้าร่วมโปรแกรม Super TRIO<br>
            โปรแกรมปกป้องสุนัขจากปรสิตร้ายที่อันตรายถึงชีวิต
        </p>
        <img class="my-4" src="{{url('/app-banner.png')}}"/>
        <p class="text-center">
            สามารถพาน้อง {{$client->pet_name}}<br>
            ขนาด {{$client->pet_weight}}<br>
            ไปรับคำปรึกษา
            และเข้าร่วมโปรแกรม Super TRIO<br>
            ได้ที่ {{$client->vet_id?App\Models\Vet::find($client->vet_id)->vet_name:'-'}}<br>
        </p>
        <p class="text-center">
            กรุณากดรับสิทธิ์ขณะอยู่ที่คลินิกตามที่ลงทะเบียน
        </p>

        <div class="py-2 text-center flex justify-center mt-auto">
            <!-- <div></div> -->
            <!-- <x-button lg outline icon="chevron-left" primary
                wire:click="back(1)" type="button" label="Back" /> -->
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
                wire:click="go(2)" type="button" label="กดเพื่อแสดงหลักฐาน" />
        </div>

    </div>

    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 2 ? 'hidden' : '' }}" id="step-4">
        <div class="text-center my-8 p-4 rounded-3xl text-white bg-primary-blue"> 
            <p class="my-4 leading-loose text-2xl">
                รหัสจะมีอายุ 15 นาที <br>
                ท่านจะสามารถใช้งานได้<br>
                ขณะอยู่ที่ คลินิก หรือ <br>
                โรงพยาบาลสัตว์<br>
                ที่ลงทะเบียนเท่านั้น
            </p>
            <p class="my-4 leading-loose text-2xl">
                มิฉะนั้น รหัส<br>
                จะไม่สามารถใช้งานได้ <br>
                หากมีข้อสงสัย ติดต่อ <br>
                <div class="flex flex-wrap justify-center gap-2 mt-4">
                    <x-button rounded class="m-2 p-2"  green href="https://line.me/ti/p/%40PetsSociety" label="Line : @PetsSociety" />
                    <x-button rounded class="m-2 p-2"  sky href="https://www.facebook.com/PetsSocietybyZoetis" label="facebook.com/PetsSocietybyZoetis" />
                </div>
               
            </p>
        </div>
        <div class="py-2 text-center flex justify-between mt-auto">
            <!-- <div></div> -->
            <x-button lg outline icon="chevron-left"
                wire:click="go(1)" type="button" label="ยกเลิก" />
            <x-button lg right-icon="chevron-right" primary  class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
                wire:click="go(3)" type="button" label="กดเพื่อแสดงหลักฐาน" />
        </div>
    </div>

    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 3 ? 'hidden' : '' }}" id="step-4">
        <h3 class="text-center text-xl my-4 p-4 font-bold text-primary-blue"> กรุณากรอกรหัสคลินิก <br>หรือ โรงพยาบาลสัตว์ </h3>
        <p class="text-center mb-8">
            (สอบถามที่พนักงานของคลินิก)
        </p>
        
        <x-input wire:model="input_vet_id" label="รหัสคลินิก หรือ โรงพยาบาลสัตว์" placeholder="รหัสคลินิก หรือ โรงพยาบาลสัตว์"/>
        @if ($status == -1)
            <div class="my-2">
                <x-badge negative label="รหัสคลินิก หรือ โรงพยาบาลสัตว์ ไม่ถูกต้อง" />
            </div>
        @endif
        <div class="mt-2">
            <x-checkbox class="rounded-full" label="รับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO" 
                        value="standard" wire:model="offer" />
            <x-checkbox class="rounded-full" label="รับสิทธิพิเศษเพิ่มเติม" 
                        value="extra" wire:model="offer" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto">
            <x-button lg right-icon="chevron-right" primary  class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
                wire:click="verifyVet" type="button" label="รับสิทธิ์" />
        </div>
    </div>

    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 4 ? 'hidden' : '' }}" id="step-4">
        <p class="text-center mb-8">
            น้อง {{$client->pet_name}}<br>
            ขนาด {{$client->pet_weight}}<br>
            ไปรับคำปรึกษา และเข้าร่วมโปรแกรม Super TRIO<br>
            ที่ {{$client->vet_id?App\Models\Vet::find($client->vet_id)->vet_name:'-'}}<br>
        </p>
        <p class="text-center">
            รหัส
            <span class="text-center text-xl mb-8 p-4 font-bold text-white bg-primary-blue block">
                {{$client_code}}
            </span>
        </p>
        <p class="text-center">
            รหัสจะหมดอายุใน
            
            <span class="text-center text-xl mb-8 p-4 font-bold text-white bg-primary-blue block">
                {{$leftMin}} : {{$leftSec}}
            </span>
        </p>
        <!-- {{$client->active_status}} -->
        @if ($timeleft>0 && $client->active_status === 'await')
            <button wire:poll.1000ms="decrement"></button>
        @endif
            
        
        <!-- <x-button lg right-icon="chevron-right" primary
                wire:click="countdown" type="button" label="update time" />
            
        <div class="py-2 text-center flex justify-center mt-auto">
            <x-button lg right-icon="chevron-right" primary
                wire:click="go(5)" type="button" label="รับสิทธิ์" />
        </div> -->
    </div>

    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 5 ? 'hidden' : '' }}" id="step-4">
        <p class="text-center mb-8">
            น้อง {{$client->pet_name}}<br>
            ขนาด {{$client->pet_weight}}<br>
            ไปรับคำปรึกษา และเข้าร่วมโปรแกรม Super TRIO<br>
            ที่ {{$client->vet_id?App\Models\Vet::find($client->vet_id)->vet_name:'-'}}<br>
        </p>
        <p class="text-center">
            รหัสของคุณหมดอายุแล้ว
            <span class="text-center text-xl mb-8 p-4 font-bold text-white bg-gray-dark block">
                {{$client_code}}
            </span>
        </p>
        
        <!-- <div class="py-2 text-center flex justify-center mt-auto">
            <x-button lg right-icon="chevron-right" primary
                wire:click="countdown" type="button" label="รับสิทธิ์" />
        </div> -->
    </div>


    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 6 ? 'hidden' : '' }}" id="step-4">
        <p class="text-center mb-8">
            น้อง {{$client->pet_name}}<br>
            ขนาด {{$client->pet_weight}}<br>
            ไปรับคำปรึกษา และเข้าร่วมโปรแกรม Super TRIO<br>
            ที่ {{$client->vet_id?App\Models\Vet::find($client->vet_id)->vet_name:'-'}}<br>
        </p>
        
        <p class="text-center">
            
            <span class="text-center text-xl mb-8 p-4 font-bold text-white bg-primary-blue block">
                ยืนยันแล้ว
            </span>
        </p>
        
        <!-- <div class="py-2 text-center flex justify-center mt-auto">
            <x-button lg right-icon="chevron-right" primary
                wire:click="countdown" type="button" label="รับสิทธิ์" />
        </div> -->
    </div>

</div>
