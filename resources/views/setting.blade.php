<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/js/delete.js"></script>
    <title>設定</title>
</head>

<body>
    <h1>設定</h1>
    <ul class="setting_box">
        <li><a href="/setting/profile">プロフィール変更</a></li>
        <li><a href="{{url('/setting/password')}}">パスワード</a></li>
        <li><button class="delete_btn" onclick="deleteUser()">アカウント削除</button></li>
        <div id="user-id" data-user-id="{{ auth()->user()->id }}"></div>

    </ul>
    <button class="logout">ログアウト</button>
    <div class="return_btn"><a href="{{route('mypage')}}">戻る</a></div>
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
    }

    .setting_box {
        display: block;
        background-color: #fff;
        width: 500px;
        height: 300px;
        padding: 30px;
        border-radius: 10px;
        margin: 20px auto;
    }

    .setting_box li {
        list-style: none;
        text-decoration: none;
        border-bottom: 1px solid #D9D9D9;
        width: 80%;
        margin: 10px auto;
        font-size: 18px;

    }

    .setting_box li button {
        background-color: #fff;
        border: none;
        font-size: 18px;
        padding: 0;
        width: 80%;
        text-align: left;
        cursor: pointer;
    }

    .setting_box li a {
        text-decoration: none;
        color: black;
    }

    .logout {
        width: 300px;
        margin: 0 auto;
        padding: 5px 0 5px 0;
        display: block;
        color: black;
        background-color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 18px;
        cursor: pointer;
    }

    .return_btn {
        margin: 20px auto;
        width: 300px;
        background-color: #fff;
        text-align: center;
        border-radius: 10px;
        padding: 5px 0 5px 0;
    }

    .return_btn a {
        text-decoration: none;
        color: black;
        font-size: 18px;
    }
</style>

</html>