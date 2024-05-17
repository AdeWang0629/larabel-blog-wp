<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UniverFoods.com</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
        <div class="spinner-border"></div>

        <form method="POST" action="{{ route('login') }}" id="login-form" hidden>
            @csrf

            <h1>自動ログイン</h1>
            
            <div>
                <p><label>メール</label></p>
                <input type="text" value="{{$email}}" class="input-text" id="email" name="email" />
            </div>

            <button type="submit">確　認</button>
        </form>
    </div>

    <script>
        window.onload = function() {
            document.getElementById('login-form').submit();
        }
    </script>
</body>
</html>