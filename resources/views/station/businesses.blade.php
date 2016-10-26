@extends('layouts.main')


@section('content')
    <main>
        <ul>
            @foreach($data->businesses as $b)
                <li>
                    <a href="{{$b->url}}">
                        <h2>{{$b->name}}</h2>
                    </a>
                    <small>{{round($b->distance,2)}} miles from {{ $data->stations[$map[$b->station]]->name }}</small>

                    //use $b->rating and $b->review_count to get Yelp ratings
                </li>
            @endforeach
        </ul>
    </main>
@endsection