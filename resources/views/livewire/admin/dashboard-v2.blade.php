<div>
<nav class="flex justify-start items-center flex-wrap gap-2">
    <x-application-logo class="block h-10 w-auto fill-current text-gray-800" />

    <x-button flat label="dashboard" icon="template" href="{{route('admin.dashboard')}}" />
    <x-button flat label="Vet" icon="shopping-cart" href="{{route('admin.vets')}}" />

    <!-- <x-select class="py-4 ml-auto w-full sm:w-auto" 
    placeholder="ค้นหาชื่อคลินิก" :options="$vet_list" option-label="name" option-value="id" wire:model="VetSelect" /> -->
    <x-dropdown>
        <x-slot name="trigger">
            <x-button.circle icon="user" label="Options" primary />
        </x-slot>
        
        <x-dropdown.item separator label="Logout" icon="logout" wire:click="logout" />
    </x-dropdown>
    <div class="flex flex-col gap-2 content-end hidden">
        <span class="flex">
            <x-badge icon="home" label="Name" indigo />
            <x-dropdown>
                <!-- <x-dropdown.item label="My Profile" /> -->
                <x-dropdown.item label="Logout" wire:click="logout" />
            </x-dropdown>
        </span>
        <x-badge flat icon="information-circle" info label="id" />
    </div>
</nav>

<div class="overflow-x-auto" id="dashboard">
    <div class="flex justify-start gap-4 mt-4">
        <div class="text-right bg-primary-blue rounded-2xl text-primary-lite p-4 shadow-lg ">
            Total :
            <span class="text-4xl font-black">{{$all_client->count()}}</span>
        </div>
        <div class="text-right rounded-2xl text-black/70 p-4 shadow-lg ">
        Complete :
            <span class="text-2xl font-bold block">{{$all_client->where('active_status','activated')->count()}}</span>
        </div>
        <div class="text-right rounded-2xl text-black/70 p-4 shadow-lg ">
        Waiting :
            <span class="text-2xl font-bold block">{{$all_client->where('active_status','<>','activated')->count()}}</span>
        </div>
    </div>

    <div class="text-primary-blue flex flex-wrap gap-2 my-4">
        <span>
            รับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO <span class="font-bold text-xl text-black/70">
                {{$all_client->where('option_1','1')->count()}}
            </span>
        </span>
        <span>
            รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 1 เดือน <span class="font-bold text-xl text-black/70">
                {{$all_client->where('option_2','1')->count()}}
            </span>
        </span>
        <span>
            รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 3 เดือน <span class="font-bold text-xl text-black/70">
                {{$all_client->where('option_3','1')->count()}}
            </span>
        </span>

    </div>

    <div class="mt-7 overflow-x-auto">
        <table class="table-fixed min-w-full whitespace-nowrap">
            <thead>
                <tr class="border border-primary-blue bg-primary-blue text-primary-lite text-xs">
                    <th class="">
                        <x-button flat white right-icon="{{$sort_icon['id']}}"
                            class="w-full hover:bg-white/10" 
                            wire:click="order('id')" label="ลำดับ"/>
                        </th>
                    <th class="hidden sm:table-cell">
                        <x-button flat white right-icon="{{$sort_icon['updated_at']}}"
                            class="w-full hover:bg-white/10" 
                            wire:click="order('updated_at')" label="วันที่"/>
                        </th>
                    <th class="hidden sm:table-cell">

                        <x-button flat white right-icon="{{$sort_icon['vet_id']}}"
                            class="w-full hover:bg-white/10" 
                            wire:click="order('vet_id')" label="ชื่อคลินิก"/>
                    </th>
                    <th class="">ชื่อลูกค้า</th>
                    <th class="hidden sm:table-cell">น้ำหนัก สุนัข</th>
                    <th class="hidden sm:table-cell">สถานะ</th>
                    <th class="hidden sm:table-cell">สิทธิ์ทั้งหมด</th>
                    <th class="hidden sm:table-cell">สิทธิ์ลงเหลือ</th>
                    <th class="hidden sm:table-cell">สิทธิ์ที่รับแล้ว</th>
                    <th class="hidden sm:table-cell">สินค้าขาด</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr class="border border-primary-blue">
                    <td class="border border-primary-blue p-2  ">
                        {{$client->client_code}}
                    </td>
                    <td class="border border-primary-blue p-2  table sm:table-cell">
                        {{Carbon\Carbon::parse($client->updated_at)->format('d/m/y')}}
                    </td>
                    <td class="border border-primary-blue p-2  table sm:table-cell">
                        {{$client->vet_id}} : 
                        {{$client->vet->vet_name??$client->vet_id}}
                    </td>
                    <td class="border border-primary-blue p-2  ">
                        {{$client->name}}
                    </td>
                    <td class="border border-primary-blue p-2  table sm:table-cell">
                        {{$client->pet_weight}}
                        <span class="sm:hidden inline-block min-w-max mr-2">น้ำหนัก สุนัข</span>
                    </td>
                    <td class="border border-primary-blue p-2  table sm:table-cell">
                        {{$client->active_status}}
                        <span class="sm:hidden inline-block min-w-max mr-2">สถานะ</span>
                    </td>
                    <td class="border border-primary-blue p-2  table sm:table-cell">
                        <!-- สิทธิ์ทั้งหมด -->
                        <!-- total stock a -->
                        <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์ทั้งหมด</span>
                        {{ $client->vet_stock }}
                    </td>
                    <td class="border border-primary-blue p-2  table sm:table-cell">
                        <!-- สิทธิ์ลงเหลือ -->
                        <!-- total stock - total activate -->
                        <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์ลงเหลือ</span>
                        {{  $client->vet_stock-$client->vet_total_activated}}
                    </td>
                    <td class="border border-primary-blue p-2  table sm:table-cell">
                        <!-- สิทธิ์ที่รับแล้ว	 -->
                        <!-- total activate -->
                        <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์ที่รับแล้ว</span>
                        {{
                            $client->vet_total_activated
                        }}
                    </td>
                    <td class="border border-primary-blue p-2  table sm:table-cell">
                        <span class="sm:hidden inline-block min-w-max mr-2">สินค้าขาด</span>
                        @if ($client->vet_stock - $client->vet_total < 0 )
                            <span class="text-red-400"> {{ $client->vet_stock - $client->vet_total }} </span>
                        @else
                            0
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4">
             {{$clients->links()}}
        </div>
    </div>
</div>
                    </div>