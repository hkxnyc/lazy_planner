@extends('layouts.main')
@section('content')
    <h1><a href="{{$line->info_url}}">{{$line->name}}</a></h1>
    @if($errors && $errors->count() > 0)
        <ul class="errorMsg">
            @foreach($errors->all() as $e)
                <li>{{$e}}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{route('stations.yelpdata')}}" method="POST">
        {{csrf_field()}}
        <label>Search:
            <input type="text" name="query"/>
        </label>
        <ul>
            @foreach($line->stations as $station)
                <li><label><input type="checkbox" name="stations[]" value="{{$station->id}}">{{$station->name}} </label></li>
            @endforeach
        </ul>
        <button>Search</button>
    </form>
@endsection