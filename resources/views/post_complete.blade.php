<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="{{ asset('css/register_confirm.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>登録完了</title>
</head>
<body>
    <main>
    <h1 class="title">Sharediary</h1>
    <p>投稿が完了しました。</p>
    <img src="{{ asset('image/check_circle.png') }}" alt="check_circle">
    <a href="{{route('top')}}">トップ画面へ</a>
    </main>
</body>
<style>
    p{
        display: block;
        margin: 0 auto;
        width: 50%;
        text-align: center;
        font-size:28px
    }

    img{
        display: block;
        width: 100px;
        margin: 0px auto 20px auto;
    }

    a{
        display: block;
        width: 100px;
        margin: 0px auto;
        text-decoration: none;
        background-color: #10B1C7;
        color: #fff;
        font-weight: bold;
        text-align: center;
        border-radius: 10px;
        padding: 5px 10px;
    }

</style>
</html>