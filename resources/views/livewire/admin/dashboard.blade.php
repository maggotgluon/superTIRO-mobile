
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
                {{$clients->where('option_1','1')->count()}}
            </span>
        </span>
        <span>
            รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 1 เดือน <span class="font-bold text-xl text-black/70">
                {{$clients->where('option_2','1')->count()}}
            </span>
        </span>
        <span>
            รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 3 เดือน <span class="font-bold text-xl text-black/70">
                {{$clients->where('option_3','1')->count()}}
            </span>
        </span>

    </div>

    <div>
        <table class="w-full table-fixed">
            <thead>
                <tr class="border border-primary-blue bg-primary-blue text-primary-lite text-xs">
                    <th class="w-8">
                        <x-button flat white right-icon="{{$sort_icon['id']}}"
                            class="w-full hover:bg-white/10" 
                            wire:click="order('id')" label="ลำดับ"/>
                        </th>
                    <th class="w-12 hidden sm:table-cell">
                        <x-button flat white right-icon="{{$sort_icon['updated_at']}}"
                            class="w-full hover:bg-white/10" 
                            wire:click="order('updated_at')" label="วันที่"/>
                        </th>
                    <th class="w-2/12 hidden sm:table-cell">ชื่อคลินิก</th>
                    <th class="w-2/12">ชื่อลูกค้า</th>
                    <th class="w-1/12">น้ำหนัก สุนัข</th>
                    <th class="w-1/12">สถานะ</th>
                    <th class="w-8 hidden sm:table-cell">สิทธิ์ทั้งหมด</th>
                    <th class="w-8 hidden sm:table-cell">สิทธิ์ลงเหลือ</th>
                    <th class="w-8 hidden sm:table-cell">สิทธิ์ที่รับแล้ว</th>
                    <th class="w-8">สินค้าขาด</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr class="border border-primary-blue">
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">{{$client->id}}</td>
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">{{Carbon\Carbon::parse($client->updated_at)->format('d/m/y')}}</td>
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">
                        <a href="{{route('admin.vetSingle',[$client->vet->user_id??''])}}">
                        {{$client->vet->vet_name??''}} {{$client->vet->id??''}}
                        </a>
                    </td>
                    <td class="border border-primary-blue p-2 sm:table-cell">{{$client->name}}</td>
                    <td class="border border-primary-blue p-2 text-center sm:table-cell">{{$client->pet_weight}}</td>
                    <td class="border border-primary-blue p-2 text-center sm:table-cell">{{$client->active_status}}</td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">
                        {{$client->vet->stock->total_stock}}
                        <!-- $client->vet?$client->vet->info()->where('meta_name','stock')->first()->meta_value:'-' }}  -->
                    </td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">
                        {{$client->vet_regis}}
                        <!-- $client->vet?$client->vet->client()->count():'0'}} -->
                    </td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">
                        {{$client->vet_total_activated}}
                        <!-- $client->vet?$client->vet->client()->where('active_status','activated')->count():'0' }} -->
                    </td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">
                        {{$client->vet_total_pending+$client->vet_total_await}}    
                        @if($client->vet)
                        <!-- ($client->vet->info()->where('meta_name','stock')->first()->meta_value??'0') - $client->vet->client()->count()>0?'':($client->vet->info()->where('meta_name','stock')->first()->meta_value??'0') - $client->vet->client()->count() }} -->
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{ $clients->links() }}
        </div>
    </div>
</div>