<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
    <title>ログイン</title>
</head>

<body>
    <div class="container">
        <h1 class="title">Sharediary</h1>
        <div class="card-body">
            <form method="POST" action="{{route('login')}}">
                @csrf
                <div class="">
                    <label for="email" class="login">ログインID：</label>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="">
                        <input id="email" type="text" name="email" placeholder="メールアドレス" value="{{ old('email') }}"
                            autofocus>
                    </div>
                </div>
                <div class="">
                    <label for="password" class="login">パスワード：</label>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="">
                        <input id="password" type="password" name="password" placeholder="パスワード">
                    </div>
                </div>


                <div class="btn">
                    <button class="login_btn" type="submit" class="">
                        ログイン
                    </button>
                    <div class="register_btn">
                        <a href="{{route('register')}}">新規登録</a>
                    </div>
                </div>
            </form>


</body>

</html>