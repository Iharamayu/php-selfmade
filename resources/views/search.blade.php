<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>Sharediary</title>
</head>

<body>
    <header>
        @include('layouts.header')
    </header>
    <div class="add_friend_box">
        <form action="{{route('user.search')}}" method="post">
            @csrf
            <label for="name">名前検索</label>
            <input type="text" name="name">
            <button type="submit">検索</button>
        </form>
    </div>
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