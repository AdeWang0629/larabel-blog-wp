@extends('layouts')

@section('content')
    <div class="row">
        <div class="col-md-6" style="display: flex;align-items: center;">
            <a href="{{ 'https://univer-goods.com/member/'.$post->userLogin.'/profile/edit/group/1/' }}" style="align-self: flex-end;"><h3>{{$post->userLogin}}</h3></a>

            <span style="padding-left: 10px;">{{$displayTime}}</span>
        </div>
    </div>
    <form method="POST" action="{{route('posts.new.modify')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value={{$post['id']}}>
        
        <div class="row my-2">
            @for ($i = 1; $i <= 6; $i++)
                @if (isset($post['images'][$i-1]))
                    <div class="col-lg-2 col-4 my-2">
                        <img id="selected-file{{$i}}" src="{{asset($post['images'][$i-1]['link'])}}" alt="Selected File" class="upload-img">
                    </div>
                @else
                    <div class="col-lg-2 col-4 my-2">
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
                <select name="big-category" id="big-category" style="width: 200px;" onchange="loadSubCategories(this.value)">
                    <option value="">クリックして選択</option>
                    @foreach ($big_categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == $post['categoryFirst']) selected @endif>
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
                    @foreach ($big_small_categories as $category)
                        <option value="{{ $small_categories[$category->small_category - 1]->id }}" @if ($small_categories[$category->small_category - 1]->id == $post['categorySecond']) selected @endif>
                            {{ $small_categories[$category->small_category - 1]->category }}
                        </option>
                    @endforeach
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
                <input type="text" id="brand-name" name="brand-name" value={{$post['brandName']}} @if(!$modify_status) disabled @endif>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    生産国
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="country-origin" name="country-origin" value={{$post['countryOrigin']}} @if(!$modify_status) disabled @endif>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    メーカー
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="maker" name="maker" value={{$post['maker']}} @if(!$modify_status) disabled @endif>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-1">
                <label>
                    購入店舗
                </label>
            </div>
            <div class="col-md-11">
                <input type="text" id="store-purchase" name="store-purchase" value={{$post['storePurchase']}} @if(!$modify_status) disabled @endif>
            </div>
        </div>
        
        <div class="row my-2">
            <div class="col-md-12 my-2">
                <p><label>ノート</label></p>
                <textarea id="note" name="note" rows="24" cols="20" style="width: 100%;" @if(!$modify_status) disabled @endif>{{$post['note']}}</textarea>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-end">
            <button type="submit" @if(!$modify_status) disabled @endif>投稿内容を修正する</button>
        </div>
    </form>

    <div class="btn-group">
 
        <button type="button" class="btn btn-primary" id="comment-button" @if(!Session::get('user_email')) disabled @endif >
            コメント
            <i class="fa fa-comment" style="font-size:16px;"></i>
        </button>

        <button type="button" class="btn btn-success" onclick="like_function({{$post['id']}})">
            いいね！
            <span id="like_icon">
                @if ($like_result)
                    <i class="fa fa-star" style="font-size:16px;"></i>
                @else
                    <i class="fa fa-star-o" style="font-size:16px;"></i>
                @endif
            </span>
        </button>

        <form method="POST" action="{{ route('posts.new.delete', $post['id']) }}" id="posts-new-delete">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" @if(!$modify_status) disabled @endif onclick="delete_function()">
                削除
                <i class="fa fa-trash" style="font-size:16px;"></i>
            </button>
        </form>

    </div>

    @if (count($post['comments']))
        @foreach ($post['comments'] as $comment)
            <div>
                <p>{{ $comment->comment }}</p>

                @if ($modify_status)
                    <form method="POST" action="{{ route('posts.comment.delete', $comment->id) }}" id="posts-comment-delete">
                        @csrf
                        @method('DELETE')
                        <button type="button" @if(!$modify_status) disabled @endif onclick="delete_comment_function()">
                            削除
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    @endif

    <div id="comment-form" style="display: none; margin-top: 10px;">
        <form method="POST" action="{{ route('posts.new.comment') }}">
            @csrf
            <input type="text" id="comment_post_id" name="comment_post_id" value="{{$post['id']}}" hidden />
            <textarea type="text" id="comment_note" name="comment_note" rows="4" cols="20" style="width: 100%;" placeholder="コメントを入力してください"></textarea>
            <button type="submit" id="comment-post" class="btn btn-success">投稿</button>
            <button type="button" id="comment-cancel" class="btn btn-danger">キャンセル</button>
        </form>
    </div>

    <script>
        document.getElementById('comment-button').addEventListener('click', function() {
            document.getElementById('comment-form').style.display = 'block';
        });

        document.getElementById('comment-cancel').addEventListener('click', function() {
            document.getElementById('comment-form').style.display = 'none';
        });

        document.getElementById('comment-post').addEventListener('click', function() {
            var commentInput = document.getElementById('comment-input');
            var comment = commentInput.value.trim();
            
            if (comment !== '') {
                // サーバーにコメントを送信する処理を実装する
                console.log('投稿するコメント: ' + comment);
                
                // コメントフォームを非表示にする
                document.getElementById('comment-form').style.display = 'none';
                
                // コメント入力フィールドを空に
                commentInput.value = '';
            }
        });

        function loadSubCategories(bigCategoryId) {
            $.post("{{ route('posts.new.load-sub-categories') }}", {
                "_token": "{{ csrf_token() }}",
                "big_category_id": bigCategoryId
            }, function(data) {
                // Update the second category dropdown with the returned data
                $('#small-category').html(data);
            });
        }

        function like_function(post_id) {
            $.post("{{ route('posts.new.like') }}", {
                "_token": "{{ csrf_token() }}",
                "post_id": post_id
            }, function(data) {
                // Update the second category dropdown with the returned data
                if (data) {
                    $('#like_icon').html("<i class='fa fa-star' style='font-size:16px;'></i>");
                } else {
                    $('#like_icon').html("<i class='fa fa-star-o' style='font-size:16px;'></i>");
                }
            });
        }

        function delete_function() {
            if (confirm("本当に削除しますか？")) {
                // User clicked "OK"
                document.querySelector('#posts-new-delete').submit();
            }
        }

        function delete_comment_function() {
            if (confirm("本当に削除しますか？")) {
                // User clicked "OK"
                document.querySelector('#posts-comment-delete').submit();
            }
        }
    </script>
@endsection