@extends('layouts')

@section('content')
    <form method="POST" action="{{route('posts.search.result')}}">
        @csrf

        <div class="row my-2">
            <div class="col-md-6 my-2">
                <label>
                    商品カテゴリ1
                </label>

                <select name="big-category" id="big-category" style="width: 200px;" onchange="loadSubCategories(this.value)">
                    <option value="">クリックして選択</option>
                    @foreach ($big_categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $big_category) selected @endif>
                        {{ $category->category }}
                    </option>
                @endforeach
                </select>
            </div>

            <div class="col-md-6 my-2">
                <label>
                    商品カテゴリ2
                </label>

                <select name="small-category" id="small-category" style="width: 200px;">
                    <option value="">クリックして選択</option>
                    @if ($small_category)
                        @foreach ($big_small_categories as $category)
                            <option value="{{ $small_categories[$category->small_category - 1]->id }}" @if ($small_categories[$category->small_category - 1]->id == $big_category) selected @endif>
                                {{ $small_categories[$category->small_category - 1]->category }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-2">
                <label>
                    商品名
                </label>
            </div>
            <div class="col-md-10">
                <input type="text" id="brand-name" name="brand-name" value={{$brandName}}>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-2">
                <label>
                    生産国
                </label>
            </div>
            <div class="col-md-10">
                <input type="text" id="country-origin" name="country-origin" value={{$countryOrigin}}>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-2">
                <label>
                    メーカー
                </label>
            </div>
            <div class="col-md-10">
                <input type="text" id="maker" name="maker" value={{$maker}}>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-2">
                <label>
                    購入店舗
                </label>
            </div>
            <div class="col-md-10">
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

    @if ($search_status)
        <div style="text-align: center">
            <h1>検索結果</h1>
        </div>
        @if (count($search_data))
            <div class="row">
                @foreach ($search_data as $post)
                    <div class="col-md-4">
                        <a href="{{ url('/modify-posts/' . $post['id']) }}">
                            @if (count($post['images']))
                                <img src="{{ asset($post['images'][0]['link']) }}" alt="{{ $post['brandName'] }}" class="img-item" />
                            @else
                                <img src="{{ asset('assets/img/no-image--recent-activity2.svg') }}" alt="{{ $post['brandName'] }}" class="img-item" />
                            @endif
                        </a>
                        <p class="my-2">
                            投稿者:  <img src="{{ 'https://univer-goods.com/wp-content/uploads/avatars/'.$post['userId'].'/'.$post['timestamp'].'-bpfull.jpg' }}" style="border-radius: 50%;width:30px;"><a href="{{ 'https://univer-goods.com/member/'.$post['userLogin'].'/profile/edit/group/1/' }}" style="align-self: flex-end;">{{$post['userLogin']}}</a><i class="fa fa-comment" style="font-size:16px;margin-left:15px;margin-right:15px;">{{count($post['comments'])}}</i>
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-container">
                <span>検索内容がありません。</span>
            </div>
        @endif
    @endif

    <script>
        function loadSubCategories(bigCategoryId) {
            $.post("{{ route('posts.new.load-sub-categories') }}", {
                "_token": "{{ csrf_token() }}",
                "big_category_id": bigCategoryId
            }, function(data) {
                // Update the second category dropdown with the returned data
                $('#small-category').html(data);
            });
        }
    </script>
@endsection