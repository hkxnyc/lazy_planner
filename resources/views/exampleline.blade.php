@extends('layouts.main')
@section('content')
    <ul>
        @foreach($lines as $line)
            <li><a href="{{route('lines.show',['lineId'=>$line->name])}}">{{$line->name}}</a> <img src="{{asset($line->picture_url)}}" alt=""> <a href="{{$line->info_url}}">More info</a></li>
        @endforeach
    </ul>
@endsection