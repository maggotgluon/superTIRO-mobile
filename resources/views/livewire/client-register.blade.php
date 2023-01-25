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
            และเข้าร่วมโปรแกรม SuperTRIO <br>
            โปรแกรมปกปองสุนัขจากปรสิตที่อันตรายถึงชีวิต
        </div>
        <div class="grid gap-2 pb-8">
            <x-input wire:model="firstname" label="ชื่อ" placeholder="ชื่อ"/>
            <x-input wire:model="lastname" label="นามสกุล" placeholder="นามสกุล"/>
            <x-input wire:model="phone" label="หมายเลขโทรศัพท์" placeholder="หมายเลขโทรศัพท์"/>
            <!-- <x-button wire:click="sendCode" type="button" label="Send Code" /> -->
            <x-input wire:model="email" label="อีเมลล์" placeholder="อีเมลล์"/>
            <div class="flex flex-col justify-center py-2">
                <x-toggle lg wire:model.defer="consent" label="ยินยอมและรับทราบนโยบายคุ้มครองข้อมูลส่วนบุคคล" required/>
                <x-button flat red label="อ่านเพิ่มเติม" wire:click="openConsent"/>

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
            หนังสือขอความยินยอมสําหรับ <br>
            ลูกค้าบริษัทโซเอทิส (ประเทศไทย) จำกัด (Customer ConsentForm)
        </h3>
        <div class="max-h-[50vh] overflow-scroll">

            <p>
            บรษิ ัท โซเอทิส (ประเทศไทย) จาํ กัด (“บรษิ ัทฯ”) เหน็ ความสําคัญ ในการคุ้มครองข้อมูลส่วนบุคคลของท่าน ตามทีกําหนดไวใ นพระ ราชบัญญัติคุ้มครองข้อมูลส่วนบุคคลพ.ศ.2562บรษิ ัทฯจงึ ได้ จดั ทําหนังสือขอความยินยอมสําหรบัลูกค้าในการเก็บรวบรวมใช้ หรอื เปดเผยข้อมูลส่วนบุคคลของท่านในฐานะลูกค้า ผูใ ช้สินค้า หรอื ผู้รบั บรกิ ารของบรษิ ัท เพือขอความยินยอมจากท่านสําหรบั วตั ถุประสงค์ทีบรษิ ัทฯไม่สามารถเก็บรวบรวมใช้หรอื เปดเผย ข้อมูลส่วนบุคคลของท่านด้วยฐานทางกฎหมายอนื ได้
            </p><p>
            ข้าพเจา้ ใหค้ วามยินยอมต่อบรษิ ัทฯ ในการเก็บรวบรวม ใช้ หรอื เปดเผยข้อมูลส่วนบุคคลของข้าพเจา้ เพือวตั ถุประสงค์ต่อไปนี
            </p><p>
            เก็บรวบรวมใช้หรอื เปดเผยข้อมูลส่วนบุคคลของข้าพเจา้ เพือ วตั ถุประสงค์ในการทําการตลาดและการติดต่อสือสารกับ ข้าพเจา้ ซึงบรษิ ัทฯ ไม่สามารถอา้ งองิ ฐานทางกฎหมายอนื ได้ เช่นการแจง้ ข่าวสารด้านการตลาดการทําการตลาดแบบตอกยา ความสนใจ (Re-Marketing) โฆษณา สิทธปิ ระโยชน์ การขาย ข้อเสนอพิเศษการแจง้ เตือนจดหมายข่าวรายงานความคืบหน้า ประกาศกิจกรรมส่งเสรมิ การขายข่าวสารและข้อมูลทีเกียวกับ ผลิตภัณฑ์หรอืบรกิารของบรษิัทและพันธมิตรทางธรุกิจของบริ ษัทฯ
            </p><p>
            เก็บรวบรวมใช้หรอื เปดเผยข้อมูลส่วนบุคคลทีละเอยี ดออ่ นของ ข้าพเจา้ เช่นข้อมูลศาสนาทีปรากฎบนสําเนาบัตรประจาํตัว ประชาชนหรอื เอกสารทีทางราชการออกให้เพือวตั ถุประสงค์ใน การยืนยันตัวตนและระบุตัวตนของข้าพเจา้
            </p><p>
            ข้าพเจา้ ขอรบั รองและยืนยันวา่ ข้าพเจา้ ได้อา่ นและทราบถงึ ราย ละเอยีดของนโยบายความเปนส่วนตัวของบรษิ ัทฯทีปรากฎณ https://www2.zoetis.co.th/privacy-policyซึงอธบิ ายวธิ ี การทีบรษิ ัทฯเก็บรวบรวมใช้หรอื เปดเผยข้อมูลส่วนบุคคลของ ข้าพเจา้
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
        <h3 class="text-center text-xl mt-8 pb-2 font-bold"> กรุณากรอกข้อมูลน้องหมา </h3>
        <p class="text-center">
            ที่ต้องการรับโปรแกรม Super TRIO
        </p>

        <div class="grid gap-2 pb-8">
            <x-input wire:model="pet_name" label="ชื่อน้อมงหมา" placeholder="ชื่อน้อมงหมา"/>

            <x-native-select label="ชื่อพันธุ์สุนัข" wire:model.defer="pet_breed"
                placeholder="เลือกพันธุ์สุนัข"
                :options="['Active', 'Pending', 'Stuck', 'Done']" />


                เลือกช่วงน้ำหนักของน้อมหมา
        <div class="grid grid-cols-2 gap-2">
            <x-radio id="weigth-1" value="weigth-1" label="1.25-2.5 กก." wire:model.defer="pet_weigth" />
            <x-radio id="weigth-2" value="weigth-2" label="2.6-5 กก." wire:model.defer="pet_weigth" />
            <x-radio id="weigth-3" value="weigth-3" label="5.1-10 กก." wire:model.defer="pet_weigth" />
            <x-radio id="weigth-4" value="weigth-4" label="10.1-20 กก." wire:model.defer="pet_weigth" />
            <x-radio id="weigth-5" value="weigth-5" label="20.1-40 กก." wire:model.defer="pet_weigth" />
            <x-radio id="weigth-6" value="weigth-6" label="40.1-60 กก." wire:model.defer="pet_weigth" />
        </div>

            <div class="grid grid-cols-2 gap-2">
                <x-native-select label="อายุ (เดือน)" wire:model.defer="pet_age_month"
                    placeholder="ระบุเดือน"
                    :options="['1', '2', '3', '4']" />
                <x-native-select label="อายุ (ปี)" wire:model.defer="pet_age_year"
                    placeholder="ระบุปี"
                    :options="['1', '2', '3', '4']" />
            </div>
        </div>



        <div class="py-2 text-center flex justify-between mt-auto">
            <!-- <div></div> -->
            <!-- <x-button lg outline icon="chevron-left" primary
                wire:click="back(1)" type="button" label="Back" /> -->
            <x-button lg right-icon="chevron-right" primary
                wire:click="secondStepSubmit" type="button" label="ถัดไป" />
        </div>
    </div>
    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 3 ? 'hidden' : '' }}" id="step-3">
                <h3> เลือกคลีนิก หรือโรงพยาบาลสัตว์ </h3>
                <p>ที่ต้องการรับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO</p>

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
                        wire:model.defer="vet_id" />
                    </div>
                @endforeach
                </div>
                <!-- {{$vet_id}}
                <x-input label="search" wire:model.debounce.1000ms="selected_vet_text" /> -->

        <!-- <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
        <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button> -->



        <div class="py-2 text-center flex justify-between mt-auto">
            <!-- <div></div> -->
            <!-- <x-button lg outline icon="chevron-left" primary
                wire:click="back(1)" type="button" label="Back" /> -->
            <x-button lg right-icon="chevron-right" primary
                wire:click="thirdStepSubmit" type="button" label="ถัดไป" />
        </div>
    </div>
    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 4 ? 'hidden' : '' }}" id="step-4">
        <h3 class="text-center text-xl mt-8 pb-2 font-bold"> การลงทะเบียนเสร็จสมบูรณ์ </h3>
        <p class="text-center">
            ท่านได้รับสิทธิ์ รับคำปรึกษา <br>
            และเข้าร่วมโปรแกรม Super TRIO<br>
            โปรแกรมปกป้องสุนัขจากปรสิตร้ายที่อันตรายถึงชีวิต
        </p>
        <p class="text-center">
            สามารถพาน้อง {{$pet_name}}<br>
            ขนาด<br>
            ไปรับคำปรึกษา<br>
            และเข้าร่วมโปรแกรม Super TRIO<br>
            ได้ที่ vet_id<br>
        </p>
        <p class="text-center">
            กรุณากดรับสิทธิ์ขณะอยู่ที่คลีนิกตามที่ลงทะเบียน
        </p>
    </div>

</div>

