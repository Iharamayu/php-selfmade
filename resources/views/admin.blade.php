<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/js/delete_admin.js"></script>
    <title>admin</title>
</head>

<body>
    <header>
        <div class="title">Sharediary</div>
        <div class="logout"><a href="/">ログアウト</a></div>
    </header>
    <div class="wrap">
        <h1>Users List</h1>
        <table class="list_box">
            <thead>
                <tr>
                    <th>No</th>
                    <th>名前</th>
                    <th>メール</th>
                    <th>誕生日</th>
                    <th>居住地</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                @if ($user->role === 1)
                <tr data-user-id="{{ $user->id }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->birthdate }}</td>
                    <td>{{ $user->prefecture->name }}</td>
                    <td><a href="{{ route('detail', ['id' => $user->id]) }}">詳細</a></td><!--詳細画面に飛ぶリンク-->
                    <td><button class="delete_btn" onclick="deleteUser({{ $user->id }})">削除</button></td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

</body>
<style>
    body {
        margin: 0;
        padding: 0;
        width: 1200px;
        height: 900px;
        background: linear-gradient(to top, #79C2EF 0%, #CAE5E3 100%);
        font-family: "Alef";
    }

    header {
        width: 1200px;
        display: flex;
        margin: 0 auto;
        background: linear-gradient(to top, #AED265 0%, #10B1C7 100%);
        justify-content: space-between;
    }

    .title {
        font-size: 28px;
        color: #fff;
        font-family: "Alef";
        text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.5);
        padding: 10px;
        margin-left: 150px;
    }
    .logout{
        padding-top:10px ;
    }

    header a {
        color: #fff;
        text-decoration: none;
        font-size: 22px;
        text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.5);
        margin-right: 150px;
    }

    .wrap {
        width: 70%;
        height: auto;
        margin: 0 auto;
        text-align: center;
    }

    h1 {
        font-size: 28px;
        margin: 30px;
    }

    .list_box {
        background-color: #fff;
        width: 100%;

    }

    .list_box th,
    .list_box td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .list_box th {
        background-color: #10B1C7;
        color: #fff;
    }
</style>

</html>