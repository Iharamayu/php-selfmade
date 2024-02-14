<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Confirm</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>検索結果</title>
</head>

<body>
    <header>
        @include('layouts.header')
    </header>
    <ul class="add_friend_box">
        <h2>検索結果</h2>
        @foreach($users as $user)
        <li>
            {{ $user->name }}
            <form action="{{ route('user.add', ['user' => $user->id]) }}" method="post">
                @csrf
                <button type="submit">追加</button>
            </form>
        </li>
        @endforeach
    </ul>
</body>
<style>
    body {
        margin: 0;
        padding: 0;
        height: 900px;
        background: linear-gradient(to top, #79C2EF 0%, #CAE5E3 100%);
        font-family: "Alef";
        align-items: center;
        justify-content: center;
    }

    h2 {
        display: block;
        width: 300px;
        margin: 0px auto;
        text-align: center;
        font-size: 24px;
    }

    .add_friend_box {
        padding: 20px;
        background-color: white;
        /* 背景色を追加 */
        border-radius: 8px;
        /* 角丸を追加 */
        width: 500px;
        margin: 100px auto;
    }

    form {
        width: 500px;
        display: flex;
        flex-direction: column;
        margin: 0 auto;
    }

    li{
        display: flex;
        flex-direction: column;
        font-size: 18px;
        text-align: center;
        margin-top: 20px;
    }

    .add_friend_box label {
        font-size: 20px;
        margin-bottom: 20px;
    }

    .add_friend_box input {
        margin: 0 auto;
        width: 100%;
        font-size: 18px;
    }

    .add_friend_box button {
        width: 100px;
        padding: 3px 10px;
        font-size: 20px;
        border-radius: 10px;
        border: none;
        margin: 10px auto 0 auto;
        background-color: #10B1C7;
        color: #fff;
    }
</style>

</html>