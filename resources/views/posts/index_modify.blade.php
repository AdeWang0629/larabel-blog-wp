@extends('layouts')

@section('content')
    <div class="row">
        <div class="col-md-6" style="display: flex;align-items: center;">
            <h3>石澤伸行</h3>
        </div>
    </div>
    <form method="POST" action="{{route('posts.new.modify')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="1111111111111111111">
        <div class="row my-2">
            @for ($i = 1; $i <= 6; $i++)
                @if (isset($post['images'][$i-1]))
                    <div class="col-sm-2 col-4 my-2">
                        <img id="selected-file{{$i}}" src="{{asset($post['images'][$i-1]['link'])}}" alt="Selected File" class="upload-img">
                    </div>
                @else
                    <div class="col-sm-2 col-4 my-2">
                        <label id="upload-label" for="upload-file{{$i}}">
                            <span id="file-icon{{$i}}">+</span>
                            <img id="selected-file{{$i}}" src="#" alt="Selected File" style="display: none;" class="upload-img">
                        </label>
                        <input type="file" id="upload-file{{$i}}" name="upload-file{{$i}}" style="display: none;" onchange="previewFile({{$i}})">
                    </div>
                @endif
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
                <input type="text" id="brand-name" name="brand-name" value={{$post['brandName']}}>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    生産国
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="country-origin" name="country-origin" value={{$post['countryOrigin']}}>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    メーカー
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="maker" name="maker" value={{$post['maker']}}>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    購入店舗
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="store-purchase" name="store-purchase" value={{$post['storePurchase']}}>
            </div>
        </div>
        
        <div class="row my-2">
            <div class="col-md-12 my-2">
                <p><label>ノート</label></p>
                <textarea id="note" name="note" rows="12" cols="20" style="width: 100%;" value={{$post['note']}}>
                </textarea>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-end">
            <button type="submit">投稿内容を修正する</button>
        </div>
    </form>
@endsection