@extends('layouts.main')
@section('content')
    <h1><a href="{{$line->info_url}}">{{$line->name}}</a></h1>
    <form action="{{route('stations.yelpdata')}}" method="POST">
        {{csrf_field()}}
        <ul>
            @foreach($line->stations as $station)
                <li><label><input type="checkbox" name="stations[]" value="{{$station->id}}">{{$station->name}} </label></li>
            @endforeach
        </ul>
        <button>Save</button>
    </form>
@endsection