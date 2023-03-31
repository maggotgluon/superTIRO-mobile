<x-app-layout>
    @if(Auth::user()->name=='admin')
        admin
    @else
        <livewire:vet-dashboard />
    @endif
</x-app-layout>
