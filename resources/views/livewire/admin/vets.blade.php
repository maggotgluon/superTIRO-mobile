
<div class="overflow-x-auto" id="vets">
    <div class="flex justify-start gap-4 my-4">
        <div class="bg-primary-blue rounded-2xl text-primary-lite p-4 shadow-lg flex gap-2">
            Total :
            <span class="text-4xl font-black">{{$all_client->count()}}</span>
        </div>

    </div>
    <div class="w-full">
        <table class="border-collapse border border-primary-blue min-w-full">
            <thead>
                <tr class="border border-primary-blue bg-primary-blue text-primary-lite text-xs">
                    <th class="w-1/12">Code</th>
                    <th class="w-4/12">ชื่อคลินิก</th>
                    <th class="w-1/12 hidden sm:table-cell">จำนวน ที่รอ</th>
                    <th class="w-1/12 hidden sm:table-cell">จำนวน ที่รับแล้ว</th>
                    <th class="w-1/12 hidden sm:table-cell">จำนวน ที่ยกเลิก</th>
                    <th class="w-1/12 hidden sm:table-cell">จำนวน ครั้งที่ดติม</th>
                    <th class="w-1/12 hidden sm:table-cell">สินค้า คลเหลือ</th>
                    <th class="w-1/12 hidden sm:table-cell">สินค้า ขาด</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vets as $vet)
                <tr class="border border-primary-blue">
                    <td class="border border-primary-blue p-2">{{$vet->id}}</td>
                    <td class="border sm:border-primary-blue p-2 table w-full sm:w-auto sm:table-cell">
                        <a href="{{route('admin.vetSingle',[$vet->id])}}">{{$vet->vet_name}}

                        <span class="whitespace-nowrap flex">
                            <x-badge outline label="{{$vet->vet_province}}" />
                            <x-badge outline label="{{$vet->vet_city}}" />
                            <x-badge outline label="{{$vet->vet_area}}" />
                        </span>
                        </a>
                    </td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell">
                        <span class="sm:hidden inline-block min-w-max mr-2">จำนวน ที่รอ</span>
                        {{$vet->client->where('active_status','await')->count()}}
                    </td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell">
                        <span class="sm:hidden inline-block min-w-max mr-2">จำนวน ที่รับแล้ว</span>
                        {{$vet->client->where('active_status','activated')->count()}}
                    </td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell">
                        <span class="sm:hidden inline-block min-w-max mr-2">จำนวน ที่ยกเลิก</span>
                        {{$vet->client->where('active_status','expired')->count()}}
                    </td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell">
                        <span class="sm:hidden inline-block min-w-max mr-2">จำนวน ครั้งที่ดติม</span>
                        {{$vet->client->count()}}
                    </td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell">
                        <span class="sm:hidden inline-block min-w-max mr-2">สินค้า คลเหลือ</span>
                        {{$vet->info?$vet->info->where('meta_name','stock')->first()->meta_value:'-'}}
                    </td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell">
                        <span class="sm:hidden inline-block min-w-max mr-2">สินค้า ขาด</span>
                        {{$vet->info?$vet->info->where('meta_name','stock')->first()->meta_value:'-'}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{ $vets->links() }}
        </div>
    </div>
</div>