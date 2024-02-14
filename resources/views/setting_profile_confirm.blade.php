<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>プロフィール確認</title>
</head>

<body>
    <div class="container">
        <div class="card-body">
            <h1>こちらの内容に変更しますか？？</h1>
            <form method="POST" action="{{route('profile.complete')}}">
                @csrf
                <div class="box">
                    {{$validatedData['name']}}
                </div>
                <div class="box">
                    {{$validatedData['email']}}
                </div>
                <div class="box">
                    {{$validatedData['birthdate']}}
                </div>
                <div class="box">
                    {{$prefecture->name}}
                </div>
                <div class="btn">
                    <button class="confirm_btn" type="submit" class="">
                        OK
                    </button>
                    <a class="cancel_btn" href="{{route('setting')}}">キャンセル</a>
                </div>
            </form>
</body>
<style>
    body {
        background-color: rgba(223, 226, 234, 0.5);
        width: 1200px;
    }

    h1 {
        display: block;
        width: 500px;
        margin: 0 auto;
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

    .box {
        display: flex;
        margin-bottom: 30px;

    }

    label {
        display: block;
        width: 120px;
    }

    input,
    select {
        box-sizing: content-box;
        padding: 0;
        border: none;
        width: 300px;
        background-color: rgba(223, 226, 234, 0.5);
        font-size: 18px;
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
</style>

</html>