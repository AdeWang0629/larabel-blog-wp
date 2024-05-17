@extends('layouts')

@section('content')
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4">
                <a href="{{ url('/modify-posts/' . $post->id) }}">
                    @if (count($post->images))
                        <img src="{{ asset($post->images[0]->link) }}" alt="{{ $post->title }}" class="img-item" />
                    @else
                        <img src="{{ asset('assets/img/no-image--recent-activity2.svg') }}" alt="{{ $post->title }}" class="img-item" />
                    @endif
                </a>
                <p class="my-2">投稿者: <a href="{{ 'https://univer-goods.com/member/'.$post->userLogin.'/profile/edit/group/1/' }}" style="align-self: flex-end;">{{$post->userLogin}}</a></p>
            </div>
        @endforeach
    </div>

    @if (!count($posts))
        <div class="no-container">
            <span>投稿内容がありません。</span>
        </div>
    @endif
@endsection