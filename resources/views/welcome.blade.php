<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .input-text {
            width: 300px;
            height: 40px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        button {
            width: 120px;
            height: 40px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h1>自動ログイン</h1>
            
            <div>
                <p><label>メール</label></p>
                <input type="text" value="{{$email}}" class="input-text" id="email" name="email" />
            </div>
            
            <div>
                <p><label>パスワード</label></p>
                <input type="text" value="{{$password}}" class="input-text" id="password" name="password" />
            </div>

            <button type="submit">確　認</button>
        </form>
    </div>
</body>
</html>