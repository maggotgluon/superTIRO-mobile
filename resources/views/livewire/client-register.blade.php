<div>
    @if(!empty($successMessage))
        <div class="alert alert-success">
            msg: {{ $successMessage }}
        </div>
    @endif

    <div class="flex justify-around {{$currentStep>=2? '' : 'hidden'}}">
        <x-button href="#step-1" label="1" class="rounded-full {{$currentStep!=1? '' : 'bg-blue-400'}} " />
        <x-button href="#step-2" label="2" class="rounded-full {{$currentStep!=2? '' : 'bg-blue-400'}} " />
        <x-button href="#step-3" label="3" class="rounded-full {{$currentStep!=3? '' : 'bg-blue-400'}} " />
        <x-button href="#step-4" label="4" class="rounded-full {{$currentStep!=4? '' : 'bg-blue-400'}} " disabled="disabled"/>
    </div>


    <div class="setup-content min-h-[70vh] flex flex-col {{ $currentStep != 1 ? 'hidden' : '' }}" id="step-1">
        <!-- <h3> Step 1</h3> -->
        <!-- $status -->
        <div class="text-center py-4">
                ฟรี! ลงทะเบียนรับคำปรึกษา <br>
        และเข้าร่วมโปรแกรม Super TRIO <br>
        โปรแกรมปกป้องสุนัขจากปรสิตร้ายที่อันตรายถึงชีวิต

        </div>
        <div class="grid gap-2 pb-8">
            <x-input wire:model="firstname" label="ชื่อ" placeholder="ชื่อ"/>
            <x-input wire:model="lastname" label="นามสกุล" placeholder="นามสกุล"/>
            <x-input wire:model="phone" label="หมายเลขโทรศัพท์" placeholder="หมายเลขโทรศัพท์"/>
            <!-- <x-button wire:click="sendCode" type="button" label="Send Code" /> -->
            <x-input wire:model="email" label="อีเมล์" placeholder="อีเมล์"/>
            <div class="flex flex-col justify-center py-2">
                @if ($consent == 1)
                    <x-toggle lg wire:model.lazy="consent"  label="ยินยอมและรับทราบนโยบายคุ้มครองข้อมูลส่วนบุคคล" required/>
                @endif
                <x-button flat red label="อ่านเพิ่มเติม นโยบายคุ้มครองข้อมูลส่วนบุคคล" wire:click="openConsent"/>

            </div>

            <div class="text-red-700 text-xs">
                หากลงทะเบียนไม่สำเร็จ <br>
                กรุณาติดต่อ <a href="#">เบอร์ 089-xxx-xxxx</a>
            </div>
        </div>

        <div class="py-2 text-center mt-auto">
            <x-button lg right-icon="chevron-right" primary
                wire:click="firstStepSubmit" type="button" label="ถัดไป" />
        </div>
    </div>

    <div class="setup-content min-h-[70vh] flex flex-col {{ $currentStep != 1.25 ? 'hidden' : '' }}" id="step-1-5">
        <h3 class="text-center text-xl mt-8 pb-2 font-bold">
            หนังสือขอความยินยอมสำหรับลูกค้า <br>
            บริษัท โซเอทิส (ประเทศไทย) จำกัด (Customer Consent Form)
        </h3>
        <div class="max-h-[50vh] overflow-scroll">
            <p>
            บริษัท โซเอทิส (ประเทศไทย) จำกัด (“บริษัทฯ”) เห็นความสำคัญในการคุ้มครองข้อมูลส่วนบุคคลของท่าน ตามที่กำหนดไว้ในพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 บริษัทฯ จึงได้จัดทำหนังสือขอความยินยอมสำหรับลูกค้าในการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของท่านในฐานะลูกค้า ผู้ใช้สินค้า หรือผู้รับบริการของบริษัท เพื่อขอความยินยอมจากท่านสำหรับวัตถุประสงค์ที่บริษัทฯ ไม่สามารถเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของท่านด้วยฐานทางกฎหมายอื่นได้
            </p><p>
            ข้าพเจ้าให้ความยินยอมต่อบริษัทฯ ในการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้าเพื่อวัตถุประสงค์ต่อไปนี้
            </p><p>
            เก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้า เพื่อวัตถุประสงค์ในการทำการตลาดและการติดต่อสื่อสารกับข้าพเจ้า ซึ่งบริษัทฯ ไม่สามารถอ้างอิงฐานทางกฎหมายอื่นได้ เช่น การแจ้งข่าวสารด้านการตลาด การทำการตลาดแบบตอกย้ำความสนใจ (Re-Marketing) โฆษณา สิทธิประโยชน์ การขาย ข้อเสนอพิเศษ การแจ้งเตือน จดหมายข่าว รายงานความคืบหน้า ประกาศ กิจกรรมส่งเสริมการขาย ข่าวสารและข้อมูลที่เกี่ยวกับผลิตภัณฑ์หรือบริการของบริษัท และพันธมิตรทางธุรกิจของบริษัทฯ
            </p><p>
            เก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลที่ละเอียดอ่อนของข้าพเจ้า เช่น ข้อมูลศาสนา ที่ปรากฎบนสำเนาบัตรประจำตัวประชาชน หรือเอกสารที่ทางราชการออกให้ เพื่อวัตถุประสงค์ในการยืนยันตัวตนและระบุตัวตนของข้าพเจ้า
            </p><p>
            ข้าพเจ้าขอรับรองและยืนยันว่า ข้าพเจ้าได้อ่านและทราบถึงรายละเอียดของนโยบายความเป็นส่วนตัวของบริษัทฯ ที่ปรากฎ ณ https://www2.zoetis.co.th/privacy-policy ซึ่งอธิบายวิธีการที่บริษัทฯ เก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้า
            </p>
        </div>

        <div class="py-2 text-center mt-auto">
            <x-button lg icon="chevron-left" primary
                wire:click="back(1)" type="button" label="กลับ" />
        </div>
    </div>

    <div class="setup-content min-h-[70vh] flex flex-col {{ $currentStep != 1.5 ? 'hidden' : '' }}" id="step-1-5">
        <h3 class="text-center text-xl mt-8 pb-2 font-bold"> ยืนยัน OTP </h3>
        <p class="text-center">
            เราได้ส่ง SMS ไปยังหมายเลข {{$phone}}
        </p>

        <div class="single-input-container flex gap-2 my-8">
            <input wire:model="otp.0" type="text" maxlength="1" class="{{$status=='error'?'border-red-400 ring-2 ring-red-700':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"/>
            <input wire:model="otp.1" type="text" maxlength="1" class="{{$status=='error'?'border-red-400 ring-2 ring-red-700':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"/>
            <input wire:model="otp.2" type="text" maxlength="1" class="{{$status=='error'?'border-red-400 ring-2 ring-red-700':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"/>
            <input wire:model="otp.3" type="text" maxlength="1" class="{{$status=='error'?'border-red-400 ring-2 ring-red-700':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"/>
            <input wire:model="otp.4" type="text" maxlength="1" class="{{$status=='error'?'border-red-400 ring-2 ring-red-700':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"/>
            <input wire:model="otp.5" type="text" maxlength="1" class="{{$status=='error'?'border-red-400 ring-2 ring-red-700':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"/>
        </div>
        @if ($status == 'error')
            <x-badge icon="exclamation" nagative label="Your OTP is not match, please try agein" />

            <x-button lg outline icon="chevron-left" primary
                wire:click="back(1)" type="button" label="Back" />
        @endif
        <!-- <input wire:model="code" type="text" class="border-gray-300 text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"/> -->
        <!-- <x-button wire:click="verifyCode" type="button" label="verifyCode" /> -->

        <div class="py-2 text-center mt-auto">
            <x-button lg right-icon="chevron-right" primary
                wire:click="varifyOTP" type="button" label="ถัดไป" />
        </div>
    </div>

    <div class="setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 2 ? 'hidden' : '' }}" id="step-2">
        <h3 class="text-center text-xl mt-8 pb-2 font-bold"> กรุณากรอกข้อมูลสุนัข </h3>
        <p class="text-center">
        ที่ต้องการรับโปรแกรม Super TRIO<br>
ปลุกพลัง 3 ชั้น ป้องกันปรสิต
        </p>

        <div class="grid gap-2 pb-8">
            <x-input wire:model="pet_name" label="ชื่อสุนัข" placeholder="ชื่อน้อมงหมา"/>

            <x-native-select label="ชื่อพันธุ์สุนัข" wire:model.lazy="pet_breed"
                placeholder="เลือกพันธุ์สุนัข"
                :options="['Active', 'Pending', 'Stuck', 'Done']" />


                เลือกช่วงน้ำหนักของสุนัข
        <div class="grid grid-cols-2 gap-2">
            <x-radio id="weigth-1" value="1.25-2.5 กก." label="1.25-2.5 กก." wire:model.lazy="pet_weigth" />
            <x-radio id="weigth-2" value="2.6-5 กก." label="2.6-5 กก." wire:model.lazy="pet_weigth" />
            <x-radio id="weigth-3" value="5.1-10 กก." label="5.1-10 กก." wire:model.lazy="pet_weigth" />
            <x-radio id="weigth-4" value="10.1-20 กก." label="10.1-20 กก." wire:model.lazy="pet_weigth" />
            <x-radio id="weigth-5" value="20.1-40 กก." label="20.1-40 กก." wire:model.lazy="pet_weigth" />
            <x-radio id="weigth-6" value="40.1-60 กก." label="40.1-60 กก." wire:model.lazy="pet_weigth" />
        </div>

            <div class="grid grid-cols-2 gap-2">
                <x-native-select label="อายุ (เดือน)" wire:model.lazy="pet_age_month"
                    placeholder="ระบุเดือน"
                    :options="['1', '2', '3', '4']" />
                <x-native-select label="อายุ (ปี)" wire:model.lazy="pet_age_year"
                    placeholder="ระบุปี"
                    :options="['1', '2', '3', '4']" />
            </div>
        </div>



        <div class="py-2 text-center flex justify-center mt-auto">
            <!-- <div></div> -->
            <!-- <x-button lg outline icon="chevron-left" primary
                wire:click="back(1)" type="button" label="Back" /> -->
            <x-button lg right-icon="chevron-right" primary
                wire:click="secondStepSubmit" type="button" label="ถัดไป" />
        </div>
    </div>

    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 3 ? 'hidden' : '' }}" id="step-3">
                <h3>เลือกคลินิก หรือโรงพยาบาลสัตว์ </h3>
                <p>ที่ต้องการรับคำปรึกษาและ<br>
                    เข้าร่วมโปรแกรม Super TRIO</p>
                


                <!-- {{$vet}} -->
                <!-- {{$vet_province}} -->

                <div class="mt-4">
                    <x-native-select
                        label="จังหวัด"
                        placeholder="เลือกจังหวัด"
                        :options="$vet_province"
                        option-label="vet_province"
                        option-value="vet_province"
                        wire:model="selected_vet_province"
                    />
                </div>
                @if ($selected_vet_province!=null)
                    <div class="mt-4">
                        <x-native-select
                            label="อำเภอ"
                            placeholder="เลือกอำเภอ"
                            :options="$vet_city"
                            option-label="vet_city"
                            option-value="vet_city"
                            wire:model="selected_vet_city"
                        />
                    </div>
                @endif

                @if ($selected_vet_city!=null)
                    <div class="mt-4">
                        <x-native-select
                            label="ตำบล"
                            placeholder="เลือกตำบล"
                            :options="$vet_area"
                            option-label="vet_area"
                            option-value="vet_area"
                            wire:model="selected_vet_area"
                        />
                    </div>
                @endif

                <div class="mt-4 bg-gray-200 p-2 h-[25vh] overflow-scroll soft-scrollbar">
                @foreach ( $vet as $vetlist )
                    <div class="mb-4">
                        <x-radio id="{{$vetlist->id}}" label="{{$vetlist->vet_name}}"
                        value="{{$vetlist->id}}"
                        wire:model.lazy="vet_id" />
                    </div>
                @endforeach
                </div>
                <!-- {{$vet_id}}
                <x-input label="search" wire:model.debounce.1000ms="selected_vet_text" /> -->

        <!-- <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
        <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button> -->



        <div class="py-2 text-center flex justify-center mt-auto">
            <!-- <div></div> -->
            <!-- <x-button lg outline icon="chevron-left" primary
                wire:click="back(1)" type="button" label="Back" /> -->
            <x-button lg right-icon="chevron-right" primary
                wire:click="thirdStepSubmit" type="button" label="ถัดไป" />
        </div>
    </div>

    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 4 ? 'hidden' : '' }}" id="step-4">
        <h3 class="text-center text-xl my-8 p-4 font-bold text-white bg-blue-600"> การลงทะเบียนเสร็จสมบูรณ์ </h3>
        <p class="text-center">
        ท่านได้รับสิทธิ์ รับคำปรึกษา <br>
        และเข้าร่วมโปรแกรม Super TRIO<br>
        โปรแกรมปกป้องสุนัขจากปรสิตร้ายที่อันตรายถึงชีวิต<br>

        </p>
        <img class="outline-1 outline-black outline my-4" src="{{url('/logo.png')}}"/>
        <p class="text-center">
        สามารถ พาน้อง {{$pet_name}}<br>
            ขนาด {{$pet_weigth}}<br>
            ไปรับคำปรึกษา<br>
            และเข้าร่วมโปรแกรม Super TRIO<br>
            ได้ที่ {{$vet_id?App\Models\Vet::find($vet_id)->vet_name:'-'}} ครับ<br>
        </p>
        <p class="text-center">
            กรุณากดรับสิทธิ์ขณะที่ท่านอยู่ที่คลินิกตามที่ลงทะเบียน
            เพื่อโชว์หลักฐานการลงทะเบียนให้คลินิกรับทราบ
            (รหัสมีอายุ 15 นาที)
        </p>
        
        <div class="py-2 text-center flex justify-center mt-auto">
            <!-- <div></div> -->
            <!-- <x-button lg outline icon="chevron-left" primary
                wire:click="back(1)" type="button" label="Back" /> -->
                
            <x-button lg right-icon="chevron-right" primary
                wire:click="activateClient()" type="button" label="กดเพื่อแสดงหลักฐาน" />
                
        </div>

    </div>
</div>

