<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>プロフィール変更</title>
</head>

<body>
    <div class="container">
        <h1>パスワード変更</h1>
        <div class="card-body">
            <form method="POST" action="{{route('password')}}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="box">
                    <label for="current_password" class="">現在のパスワード</label>
                    @error('current_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input id="current_password" type="password" name="current_password">
                </div>
                <div class="box">
                    <label for="new_password" class="">新しいパスワード</label>
                    @error('new_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input id="new_password" type="password" name="new_password">
                </div>
                <div class="box">
                    <label for="new_password-confirm" class="">確認パスワード</label>
                    @error('new_password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input id="new_password-confirm" type="password" name="new_password_confirmation">
                </div>
                <div class="btn">
                    <button class="confirm_btn" type="submit" class="">
                        確認
                    </button>
                    <a class="cancel_btn" href="{{route('setting')}}">キャンセル</a>
                </div>
            </form>

</body>
<style>
    body {
        background-color: rgba(223, 226, 234, 0.5);
        width: 1200px;
        margin: 0;
    }

    h1 {
        display: block;
        width: 500px;
        margin: 100px auto 0 auto;
        text-align: center;
    }

    .card-body {
        display: block;
        background-color: #fff;
        width: 500px;
        height: auto;
        padding: 30px;
        border-radius: 10px;
        margin: 20px auto;

    }

    form {
        width: 100%;
        margin: 0 auto;
    }

    .box {
        display: flex;
        margin-bottom: 30px;
        flex-direction: column;
    }

    label {
        display: block;
        width: 180px;
        margin-left: 100px;
        margin-bottom: 10px;
        font-size: 18px;
    }

    input,
    select {
        box-sizing: content-box;
        padding: 0;
        border: none;
        width: 300px;
        background-color: rgba(223, 226, 234, 0.5);
        font-size: 18px;
        margin: 0 auto;
    }

    .btn {
        display: flex;
        flex-direction: column;

    }

    .confirm_btn {
        border: none;
        padding: 5px;
        width: 200px;
        margin: 0 auto;
        background-color: #10B1C7;
        font-size: 18px;
        border-radius: 10px;

    }

    .cancel_btn {
        display: block;
        width: 200px;
        text-decoration: none;
        color: black;
        background-color: rgba(223, 226, 234, 0.5);
        text-align: center;
        margin: 10px auto 0 auto;
        font-size: 18px;
        padding: 5px;
        border-radius: 10px;
    }

    .alert {
        color: red;
        width: 300px;
        margin: 0 auto;
    }
    @media screen and (max-width: 900px) {
        body{
            width: 900px;
        }
        .card-body {
            width: 80%;
        }

        h1{
            width: 600px;
        }
    }

    @media screen and (max-width: 600px) {
        body{
            width: 600px;
        }
        .card-body {
            width: 100%;
            border-radius: 0px;
            padding: 30px 0;
        }

        h1{
            width: 600px;
        }
        label{
            margin-left: 40px;
        }
    }

    @media screen and (max-width: 375px) {
        body{
            width: 375px;
        }
        .card-body {
            width: 100%;
            border-radius: 0px;
            padding: 30px 0;
        }

        h1{
            width: 375px;
        }
        label{
            margin-left: 40px;
        }
    }


</style>

</html>