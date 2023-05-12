<div>
    @if(strpos($_SERVER['HTTP_USER_AGENT'], 'wv') !== false)
        Mobile Web View
    @elseif( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false)
        Mobile
    @else
        Other
    @endif

    You are using {{$device}}<br>
    {!!$browser!!}
    <ul>
    @foreach ($data as $key=>$value)
        <li>{{$key}} :: {{$value}}</li>
    @endforeach
    </ul>
</div>
