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
    <div class="grid sm:grid-cols-2 my-4 gap-4">
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
                        @if($current_vet->stock->total_stock - $data['client_all'] < 0)
                            {{$current_vet->stock->total_stock - $data['client_all']}}
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
        @if ($clients)
        <table class="w-full table-auto	">
            <thead>
                <tr class="border border-primary-blue bg-primary-blue  text-xs">
                    <th class="w-24">
                        <x-button flat white right-icon="{{$sort_icon['client_code']}}"
                        class="w-full hover:bg-white/10" 
                        wire:click="order('client_code')" label="ลำดับ"/>
                    </th>
                    <th class="w-24 hidden sm:table-cell">
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
                    <th class="w-20 text-primary-lite hidden sm:table-cell">รับสิทธิ์พิเศษเพิ่มเติม - เข้าร่วมโปรแกรม 1 เดือน</th>
                    <th class="w-20 text-primary-lite hidden sm:table-cell">รับสิทธิ์พิเศษเพิ่มเติม - เข้าร่วมโปรแกรม 3 เดือน</th>
                    <th class="w-24 hidden sm:table-cell text-primary-lite">น้ำหนัก สุนัข</th>
                    <th class="w-24 hidden sm:table-cell">
                        <x-button flat white right-icon="{{$sort_icon['active_status']}}"
                        class="w-full hover:bg-white/10" 
                        wire:click="order('active_status')" label="สถานะ" />
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr class="border border-primary-blue">
                    <td class="border sm:border-primary-blue p-2 table w-full sm:w-auto sm:table-cell">{{$client->client_code}}</td>
                    <td class="border sm:border-primary-blue p-2 table w-full sm:w-auto sm:table-cell">{{Carbon\Carbon::parse($client->updated_at)->format('d/m/y')}}</td>
                    <td class="border border-primary-blue p-2 sm:table-cell">
                        {{$client->name}}
                    </td>
                    <td class="border sm:border-primary-blue p-2 table w-full sm:w-auto sm:table-cell text-center ">
                        @if($client->option_1)
                            <span class="sm:hidden inline-block min-w-max mr-2">รับคำปรึกษาและเข้าร่วม โปรแกรม Super TRIO</span>
                            <x-badge.circle positive icon="check" class="w-5 h-5 m-auto" />
                        @endif
                    </td>
                    <td class="border sm:border-primary-blue p-2 table w-full sm:w-auto sm:table-cell text-center ">
                        @if($client->option_2 )
                            <span class="sm:hidden inline-block min-w-max mr-2">รับสิทธิ์พิเศษเพิ่มเติม - เข้าร่วมโปรแกรม 1 เดือน</span>
                            <x-badge.circle positive icon="check" class="w-5 h-5 m-auto" />
                        @endif 
                    </td>
                    <td class="border sm:border-primary-blue p-2 table w-full sm:w-auto sm:table-cell text-center ">
                        @if($client->option_3 )
                            <span class="sm:hidden inline-block min-w-max mr-2">รับสิทธิ์พิเศษเพิ่มเติม - เข้าร่วมโปรแกรม 3 เดือน</span>
                            <x-badge.circle positive icon="check" class="w-5 h-5 m-auto" />
                        @endif    
                        
                    </td>
                    <td class="border sm:border-primary-blue p-2 text-center table w-full sm:w-auto sm:table-cell">{{$client->pet_weight}}</td>
                    <td class="border sm:border-primary-blue p-2 text-center table w-full sm:w-auto sm:table-cell">{{$client->active_status??'-'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{ $clients->links() }}
        </div>
        @else
        <div>No client regis yet</div>
        @endif
    </div>
</div>
</div>