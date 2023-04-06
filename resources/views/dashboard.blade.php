<x-app-layout>
    @if(Auth::user()->name=='admin')
        <livewire:vet-stock />
    @else
        <livewire:vet-dashboard />
    @endif

</x-app-layout>
