@extends('layouts')

@section('content')
    <h1>石澤伸行</h1>
    <form action="/action_page.php">
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
                <select name="cars" id="cars" style="width: 200px;">
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
                <select name="cars" id="cars" style="width: 200px;">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-12 my-2">
                <label>
                    商品名
                </label>
                <input type="text">
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-4 my-2">
                <label>
                    生産国
                </label>
                <input type="text">
            </div>

            <div class="col-md-4 my-1">
                <label>
                    メーカー
                </label>
                <input type="text">
            </div>

            <div class="col-md-4 my-1">
                <label>
                    購入店舗
                </label>
                <input type="text">
            </div>
        </div>
        
        <div class="row my-2">
            <div class="col-md-12 my-2">
                <p><label>ノート</label></p>
                <textarea id="w3review" name="w3review" rows="4" cols="20" style="width: 100%;">
                </textarea>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-end">
            <button>この内容で投稿する</button>
        </div>
    </form>
@endsection