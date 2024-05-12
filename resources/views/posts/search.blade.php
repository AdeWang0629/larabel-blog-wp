@extends('layouts')

@section('content')
    <form method="POST" action="{{route('posts.search.result')}}">
        @csrf
        <div class="row my-2">
            <div class="col-md-6 my-2">
                <label>
                    商品カテゴリ1
                </label>
                <select name="category-first" id="category-first" style="width: 200px;">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </div>

            <div class="col-md-6 my-2">
                <label>
                    商品カテゴリ2
                </label>
                <select name="category-second" id="category-second" style="width: 200px;">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    商品名
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="brand-name" name="brand-name" value={{$brandName}}>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    生産国
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="country-origin" name="country-origin" value={{$countryOrigin}}>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    メーカー
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="maker" name="maker" value={{$maker}}>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    購入店舗
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="store-purchase" name="store-purchase" value={{$storePurchase}}>
            </div>
        </div>
        
        <div class="row my-2">
            <div class="col-md-12 my-2">
                <p><label>ノート</label></p>
                <textarea id="note" name="note" rows="12" cols="20" style="width: 100%;">
                    {{$note}}
                </textarea>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-end">
            <button type="submit">投稿内容を検索する</button>
        </div>
    </form>

    @if (count($search_data))
        @foreach ($search_data as $post)
            <div class="col-md-4">
                <a href="{{ url('/modify-posts/' . $post->id) }}">
                    <img src="{{ asset($post->images[0]->link) }}" alt="{{ $post->title }}" style="width: 100%;height: 50vh;"/>
                </a>
                <p class="my-2">投稿者: {{$post->userEmail}}</p>
            </div>
        @endforeach
    @endif
@endsection