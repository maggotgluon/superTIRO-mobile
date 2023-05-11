<div>
    You are using {{$device}}<br>
    {!!$browser!!}
    <ul>
    @foreach ($data as $key=>$value)
        <li>{{$key}} :: {{$value}}</li>
    @endforeach
    </ul>
</div>
