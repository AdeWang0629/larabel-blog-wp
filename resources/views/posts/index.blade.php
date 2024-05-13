@extends('layouts')

@section('content')
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4">
                <a href="{{ url('/modify-posts/' . $post->id) }}">
                    @if (count($post->images))
                        <img src="{{ asset($post->images[0]->link) }}" alt="{{ $post->title }}" style="width: 100%;height: auto;"/>
                    @else
                        <img src="{{ asset('assets/img/no-image--recent-activity2.svg') }}" alt="{{ $post->title }}" style="width: 100%;height: auto;"/>
                    @endif
                </a>
                <p class="my-2">投稿者: {{$post->userEmail}}</p>
            </div>
        @endforeach
    </div>

    @if (!count($posts))
        <div class="no-container">
            <span>投稿内容がありません。</span>
        </div>
    @endif
@endsection