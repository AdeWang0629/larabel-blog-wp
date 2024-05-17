@extends('layouts')

@section('content')
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4">
                <a href="{{ url('/modify-posts/' . $post['id']) }}">
                    @if (count($post['images']))
                        <img src="{{ asset($post['images'][0]['link']) }}" alt="{{ $post['brandName'] }}" class="img-item" />
                    @else
                        <img src="{{ asset('assets/img/no-image--recent-activity2.svg') }}" alt="{{ $post['brandName'] }}" class="img-item" />
                    @endif
                </a>
                <p class="my-2">
                    投稿者:  <img src="{{ 'https://univer-goods.com/wp-content/uploads/avatars/'.$post['userId'].'/'.$post['timestamp'].'-bpfull.jpg' }}" style="border-radius: 50%;width:30px;"><a href="{{ 'https://univer-goods.com/member/'.$post['userLogin'].'/profile/edit/group/1/' }}" style="align-self: flex-end;">{{$post['userLogin']}}</a><i class="fa fa-comment" style="font-size:16px;margin-left:15px;margin-right:15px;">{{count($post['comments'])}}</i> <i class="fa fa-star-o" style="font-size:15px;">{{count($post['likes'])}}</i>
                </p>
            </div>
        @endforeach
    </div>

    @if (!count($posts))
        <div class="no-container">
            <span>投稿内容がありません。</span>
        </div>
    @endif
@endsection