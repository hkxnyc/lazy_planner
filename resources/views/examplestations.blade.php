@extends('layouts.main')
@section('content')
    <h1><a href="{{$line->info_url}}">{{$line->name}}</a></h1>
    <form action="{{route('stations.example')}}" method="POST">
        {{csrf_field()}}
        <ul>
            @foreach($line->stations as $station)
                <li><input type="checkbox" name="stations[]" value="{{$station->id}}">{{$station->name}} ({{$station->longitude}}, {{$station->latitude}})</li>
            @endforeach
        </ul>
        <button>Save</button>
    </form>
@endsection