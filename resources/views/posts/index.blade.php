@extends('layouts')

@section('content')
    @foreach ($posts as $post)
        <div class="col-md-4">
            <a href="{{ url('/modify-posts/' . $post->id) }}">
                <img src="{{ asset($post->images[0]->link) }}" alt="{{ $post->title }}" style="width: 100%;height: 50vh;"/>
            </a>
            <p class="my-2">投稿者: {{$post->userEmail}}</p>
        </div>
    @endforeach
@endsection