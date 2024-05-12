@extends('layouts')

@section('content')
    <div class="row">
        <div class="col-md-6" style="display: flex;align-items: center;">
            <h4>{{$user_login}}</h4>
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
                        <span id="file-icon{{$i}}">+</span>
                        <img id="selected-file{{$i}}" src="#" alt="Selected File" style="display: none;" class="upload-img">
                    </label>
                    <input type="file" id="upload-file{{$i}}" name="upload-file{{$i}}" style="display: none;" onchange="previewFile({{$i}})">
                </div>
            @endfor
        </div>

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
                <input type="text" id="brand-name" name="brand-name">
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    生産国
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="country-origin" name="country-origin">
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    メーカー
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="maker" name="maker">
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    購入店舗
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="store-purchase" name="store-purchase">
            </div>
        </div>
        
        <div class="row my-2">
            <div class="col-md-12 my-2">
                <p><label>ノート</label></p>
                <textarea id="note" name="note" rows="12" cols="20" style="width: 100%;">
                </textarea>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-end">
            <button type="submit">この内容で投稿する</button>
        </div>
    </form>
@endsection