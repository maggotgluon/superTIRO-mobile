<div class="overflow-x-auto">
    <h2>VET Stock</h2>
    <div class="w-full">
        <table class="border-collapse border border-primary-blue min-w-full">
            <thead>
                <tr>
                    <!-- <th class="border border-primary-blue"> id </th> -->
                    <th class="border border-primary-blue"> name </th>
                    <th class="border border-primary-blue"> stock </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vets as $vet)
                    <tr>
                        <!-- <td class="border border-primary-blue"> <x-badge outline label="{{$vet->id}}" /></td> -->
                        <td class="border table-row sm:table-cell border-primary-blue"> 
                            {{$vet->vet_name}}
                            <span class="whitespace-nowrap flex">
                            <x-badge outline label="{{$vet->vet_province}}" />
                            <x-badge outline label="{{$vet->vet_city}}" />
                            <x-badge outline label="{{$vet->vet_area}}" />
                            </span>
                        </td>
                        <td class="border table-row sm:table-cell border-primary-blue text-center">{{$vet->user_id}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
