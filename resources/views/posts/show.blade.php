@extends('layout')
@section('content')
    {{--  @foreach ($posts as $post)  --}}
        
    <h1>{{ $posts->title}}</h1>
    <p>{{$posts->content}}</p>

    <p>Added {{$posts->created_at->diffForHumans()}} </p>
    
    {{(new Carbon\Carbon())->diffInMinutes($posts->created_at)}}

    @if ((new Carbon\Carbon())->diffInMinutes($posts->created_at) <5)
    New!
    @endif
@endsection('content')