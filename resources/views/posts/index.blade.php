@extends('layout')
@section('content')
   {{--  @foreach ($posts as $post)
   <p>
    <h3>{{$post->title}}</h3>
   </p>
     @endforeach  --}}
{{--  @dd($posts)  --}}
  @forelse ($posts as $post)   
      <p>
        <h3>
        {{--  {{$post->title}}  --}}
        <a href="{{ route('post.show',['post'=>$post->id])}}">{{$post->title}}</a>
        </h3> 

        @if($post->comments_count)
            <p>{{ $post->comments_count }}comments</p>
        @else
            <p> No Comment yet!!</p>
        @endif
        

        <a href="{{ route('post.edit',['post'=>$post->id]) }}">
          Edit
        </a>

         <form method="POST" action="{{route('post.destroy',['post' => $post->id])}}">
            @csrf
            @method('DELETE')
            {{--  Method Spoofing  --}}
            <input type="submit" value="Delete!"/>
         </form>
        <p>

      </p>

      @empty

      <p>
        <h3>No Data in the Database!</h3>
      </p>
         
  @endforelse
     
@endsection('content')