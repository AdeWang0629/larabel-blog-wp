@extends('layouts')

@section('content')
    <div class="row">
        <div class="col-md-6" style="display: flex;align-items: center;">
            <img src="{{ 'https://univer-goods.com/wp-content/uploads/avatars/'.$userdata['ID'].'/'.$timestamp.'-bpfull.jpg' }}" style="border-radius: 50%;">
            <a href="{{ 'https://univer-goods.com/member/'.$userdata['user_login'].'/profile/edit/group/1/' }}" style="align-self: flex-end;"><h4>{{$userdata['user_login']}}</h4></a>
        </div>
        <div class="col-md-6" style="color: red;">
            <p>
                掲載対象としては、飲食店内で供されるもの以外：
            </p>
            <p>
                スーパーで買えるデリ、商店街やネットで買える食材、
            </p>
            <p>
                飲食店のテイクアウト、お取り寄せ賞品等が対象となります。
            </p>
        </div>
    </div>
    <form method="POST" action="{{route('posts.new.create')}}" enctype="multipart/form-data">
        @csrf
    
        <div class="row my-2">
            @for ($i = 1; $i <= 6; $i++)
                <div class="col-sm-2 col-4 my-2">
                    <label id="upload-label" for="upload-file{{$i}}">
                        <span id="file-icon{{$i}}">画像</span>
                        <img id="selected-file{{$i}}" src="#" alt="Selected File" style="display: none;object-fit: cover;" class="upload-img">
                    </label>
                    <input type="file" id="upload-file{{$i}}" name="upload-file{{$i}}" style="display: none;object-fit: cover;" onchange="previewFile({{$i}})">
                    <span class="text-danger">{{ $errors->first('upload-file'.$i) }}</span>
                </div>
            @endfor
        </div>

        <div class="row my-2">
            <div class="col-md-6 my-2">
                <label>
                    商品カテゴリ1
                </label>

                <select name="big-category" id="big-category" style="width: 200px;" onchange="loadSubCategories(this.value)">
                    <option value="">クリックして選択</option>
                    @foreach ($big_categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>

                <span class="text-danger">{{ $errors->first('big-category') }}</span>
            </div>

            <div class="col-md-6 my-2">
                <label>
                    商品カテゴリ2
                </label>

                <select name="small-category" id="small-category" style="width: 200px;">
                    <option value="">クリックして選択</option>
                </select>
            </div>

            <span class="text-danger">{{ $errors->first('small-category') }}</span>
        </div>

        <div class="row my-2">
            <div class="col-md-2">
                <label>
                    商品名
                </label>
            </div>
            <div class="col-md-10">
                <input type="text" id="brand-name" name="brand-name" value="{{ old('brand-name') }}" placeholder="正式な商品名を記入してください">
                <span class="text-danger">{{ $errors->first('brand-name') }}</span>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-2">
                <label>
                    生産国
                </label>
            </div>
            <div class="col-md-10">
                <input type="text" id="country-origin" name="country-origin" value="{{ old('country-origin') }}">
                <span class="text-danger">{{ $errors->first('country-origin') }}</span>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-2">
                <label>
                    メーカー
                </label>
            </div>
            <div class="col-md-10">
                <input type="text" id="maker" name="maker" value="{{ old('maker') }}">
                <span class="text-danger">{{ $errors->first('maker') }}</span>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-2">
                <label>
                    購入店舗
                </label>
            </div>
            <div class="col-md-10">
                <input type="text" id="store-purchase" name="store-purchase" value="{{ old('store-purchase') }}">
                <span class="text-danger">{{ $errors->first('store-purchase') }}</span>
            </div>
        </div>
        
        <div class="row my-2">
            <div class="col-md-12 my-2">
                <p><label>ノート</label></p>
                <textarea id="note" name="note" rows="24" cols="20" style="width: 100%;" placeholder="当該商品の特徴・歴史等を記入してください。「#」を付けることで検索しやすくしましょう。投稿にあたって参考にした情報があれば出典を記しましょう。">{{ old('note') }}</textarea>
                <span class="text-danger">{{ $errors->first('note') }}</span>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-end">
            <button type="submit">この内容で投稿する</button>
        </div>
    </form>

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