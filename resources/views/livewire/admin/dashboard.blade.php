
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
            <span class="text-2xl font-bold block">{{$all_client->where('active_status','pending')->toQuery()->orWhere('active_status','await')->count()}}</span>
        </div>
        <div class="text-right bg-red-300 rounded-2xl text-black/70 p-4 shadow-lg ">
        Cancel :
            <span class="text-2xl font-bold block">{{$all_client->where('active_status','expired')->toQuery()->orWhere('active_status',null)->count()}}</span>
        </div>

    </div>

    <div class="text-primary-blue flex flex-wrap gap-2 my-4">
        <span>
            รับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO <span class="font-bold text-xl text-black/70">1,000</span>
        </span>
        <span>
            รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 1 เดือน <span class="font-bold text-xl text-black/70">500</span>
        </span>
        <span>
            รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 3 เดือน <span class="font-bold text-xl text-black/70">300</span>
        </span>

    </div>

    <div>
        <table class="w-full">
            <thead>
                <tr class="border border-primary-blue bg-primary-blue text-primary-lite text-xs">
                    <th class="w-1/12">ลำดับ</th>
                    <th class="w-1/12 hidden sm:table-cell">วันที่</th>
                    <th class="w-2/12 hidden sm:table-cell">ชื่อคลินิก</th>
                    <th class="w-2/12">ชื่อลูกค้า</th>
                    <th class="w-1/12">น้ำหนัก สุนัข</th>
                    <th class="w-1/12">สถานะ</th>
                    <th class="w-1/12 hidden sm:table-cell">จำนวนครั้งที่เติม</th>
                    <th class="w-1/12 hidden sm:table-cell">สินค้าลงเหลือ</th>
                    <th class="w-1/12 hidden sm:table-cell">สินค้าที่มอบแล้ว</th>
                    <th class="w-1/12">สินค้าขาด</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr class="border border-primary-blue">
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">{{$client->id}}</td>
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">{{Carbon\Carbon::parse($client->updated_at)->format('d/m/y')}}</td>
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">{{$client->vet_id}}</td>
                    <td class="border border-primary-blue p-2 sm:table-cell">{{$client->name}}</td>
                    <td class="border border-primary-blue p-2 text-center sm:table-cell">{{$client->pet_weight}}</td>
                    <td class="border border-primary-blue p-2 text-center sm:table-cell">{{$client->active_status}}</td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">{{$client->info?'1':'0'}}</td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">{{$client->info?'1':'0'}}</td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">{{$client->info?'1':'0'}}</td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">{{$client->info?'1':'0'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{ $clients->links() }}
        </div>
    </div>
</div>