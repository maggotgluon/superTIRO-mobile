<div>
    <livewire:admin/>
<div class="overflow-x-auto">
    <h2 class="text-lg text-primary-blue font-bold">
    {{$current_vet->vet_name}}
    </h2>
    <div class="flex justify-between">
        <p>
            {{$current_vet->vet_area}} {{$current_vet->vet_city}} {{$current_vet->vet_province}}<br>
            <!-- <span>tel </span> / <span> site </span> -->
        </p>
        <span class="rounded-2xl bg-primary-blue text-primary-lite/70 p-4 shadow-lg ">
            รหัส : {{$current_vet->id}}
        </span>
    </div>
    <hr class="border-2 border-primary-blue my-4" />
    <div class="grid md:grid-cols-2 my-4 gap-4">
        <div>
            <div class="flex gap-2">
                <div class=" rounded-2xl bg-primary-blue text-primary-lite/70 p-4 shadow-lg ">
                    Total :
                    <span class="text-2xl font-bold block">
                        {{$data['all_client']}}
                    </span>
                </div>
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    Complete :
                    <span class="text-2xl font-bold block">
                        {{$data['all_activated']}}
                    </span>
                </div>
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    Waiting :
                    <span class="text-2xl font-bold block">
                    {{$data['all_client']-$data['all_activated']}}
                    </span>
                </div>
            </div>
                <p class="mt-4">
                    รับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO 
                    <span class="font-bold text-xl text-black/70">
                        {{$data['all_opt1']}}
                    </span>
                </p>
                <p class="mt-2">
                    รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 1 เดือน 
                    <span class="font-bold text-xl text-black/70">
                    {{$data['all_opt2']}}
                    </span>
                </p>
                <p class="mt-2">
                    รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 3 เดือน 
                    <span class="font-bold text-xl text-black/70">
                    {{$data['all_opt3']}}
                    </span>
                </p>
        </div>

        <div>

            <div class="flex gap-2 justify-end">
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    สินค้าทั้งหมด :
                    <span class="text-2xl font-bold block">
                        {{$current_vet->stock->total_stock}}
                    </span>
                </div>
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    จำนวนครั้งที่เติม :
                    <span class="text-2xl font-bold block">
                        {{$current_vet->stock->stock_adj}}
                    </span>
                </div>
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    สินค้าคงเหลือ :
                    <span class="text-2xl font-bold block">
                        {{$current_vet->stock->total_stock - $data['all_opt1']}}
                    </span>
                </div>
                <div class=" rounded-2xl bg-red-300 text-black/70 p-4 shadow-lg ">
                    สินค้าขาด :
                    <span class="text-2xl font-bold block">
                        @if($current_vet->stock->total_stock - $data['all_opt1'] - $data['all_pending'] < 0)
                            {{$current_vet->stock->total_stock - $data['all_opt1'] - $data['all_pending'] }}
                        @else
                            -
                        @endif
                        
                    </span>
                </div>
            </div>

            <div class="text-right rounded-2xl text-black/70 p-4 shadow-lg ">
                <x-inputs.number wire:model="stock_adj" label="จำนวนสินค้าที่เติม : " />
                <x-button primary class="my-4" label="บันทึก" wire:click="add_stock_adj"/>
            </div>
        </div>

    </div>
    <div>
        <!-- {{$order}} | {{$sort}} -->
        <div class="mt-7 overflow-x-auto">
        @if ($clients)
        <table class="w-full table-auto	">
            <thead>
                <tr class="border border-primary-blue bg-primary-blue  text-xs">
                    <th class="w-24">
                        <x-button flat white right-icon="{{$sort_icon['client_code']}}"
                        class="w-full hover:bg-white/10" 
                        wire:click="order('client_code')" label="ลำดับ"/>
                    </th>
                    <th class="w-24 hidden md:table-cell">
                        <x-button flat white right-icon="{{$sort_icon['updated_at']}}"
                        class="w-full hover:bg-white/10" 
                        wire:click="order('updated_at')" label="วันที่" />
                    </th>
                    <th class="">
                        <x-button flat white right-icon="{{$sort_icon['name']}}"
                        class="w-full hover:bg-white/10" 
                        wire:click="order('name')" label="ชื่อลูกค้า" />
                    </th>
                    <th class="w-20 text-primary-lite">รับคำปรึกษาและเข้าร่วม โปรแกรม Super TRIO</th>
                    <th class="w-20 text-primary-lite hidden md:table-cell">รับสิทธิ์พิเศษเพิ่มเติม - เข้าร่วมโปรแกรม 1 เดือน</th>
                    <th class="w-20 text-primary-lite hidden md:table-cell">รับสิทธิ์พิเศษเพิ่มเติม - เข้าร่วมโปรแกรม 3 เดือน</th>
                    <th class="w-24 hidden md:table-cell text-primary-lite">น้ำหนัก สุนัข</th>
                    <th class="w-24 hidden md:table-cell">
                        <x-button flat white right-icon="{{$sort_icon['active_status']}}"
                        class="w-full hover:bg-white/10" 
                        wire:click="order('active_status')" label="สถานะ" />
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr class="border border-primary-blue">
                    <td class="align-top md:border mx-2 border-primary-blue p-2 table w-full md:w-auto md:table-cell">{{$client->client_code}}</td>
                    <td class="align-top md:border mx-2 border-primary-blue p-2 table w-full md:w-auto md:table-cell">{{Carbon\Carbon::parse($client->updated_at)->format('d/m/y')}}</td>
                    <td class="align-top border whitespace-nowrap border-primary-blue p-2 md:table-cell">
                        {{$client->name}}
                    </td>
                    <td class="align-top md:border mx-2 whitespace-nowrap border-primary-blue p-2 table w-full md:w-auto md:table-cell md:text-center ">
                        @if($client->option_1)
                        <x-badge.circle positive icon="check" class="w-5 h-5 m-auto p-2 inline-block" />
                        <span class="md:hidden inline-block min-w-max mx-2 my-1">เข้าร่วม โปรแกรม Super TRIO</span>
                        @endif
                    </td>
                    <td class="align-top md:border mx-2 whitespace-nowrap border-primary-blue p-2 table w-full md:w-auto md:table-cell md:text-center ">
                        @if($client->option_2 )
                        <x-badge.circle positive icon="check" class="w-5 h-5 m-auto p-2 inline-block" />
                        <span class="md:hidden inline-block min-w-max mx-2 my-1">เข้าร่วมโปรแกรม 1 เดือน</span>
                        @endif 
                    </td>
                    <td class="align-top md:border mx-2 whitespace-nowrap border-primary-blue p-2 table w-full md:w-auto md:table-cell md:text-center ">
                        @if($client->option_3 )
                        <x-badge.circle positive icon="check" class="w-5 h-5 m-auto p-2 inline-block" />
                        <span class="md:hidden inline-block min-w-max mx-2 my-1">เข้าร่วมโปรแกรม 3 เดือน</span>
                        @endif    
                        
                    </td>
                    <td class="align-top md:border mx-2 whitespace-nowrap border-primary-blue p-2 md:text-center table w-full md:w-auto md:table-cell">
                        <span class="md:hidden inline-block min-w-max mx-2 mt-1">น้ำหนัก สุนัข : </span> {{$client->pet_weight}}</td>
                    <td class="align-top md:border mx-2 whitespace-nowrap border-primary-blue p-2 md:text-center table w-full md:w-auto md:table-cell">
                        <span class="md:hidden inline-block min-w-max mx-2">สถานะ : </span> {{$client->active_status??'-'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="my-4">
            {{ $clients->links() }}
        </div>
        @else
        <div>No client regis yet</div>
        @endif
    </div>
</div>
</div>