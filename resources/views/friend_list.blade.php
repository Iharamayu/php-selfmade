<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Friends List</title>
    <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>フレンドリスト</title>
</head>

<body>
    <div class="box">
        <div class="back">
            <a href="{{route('mypage', ['friends' => $friends])}}"><img src="{{ asset('image/arrow_back.png') }}"
                    alt="矢印"></a>
            &nbsp;Friends
        </div>
    </div>
    @foreach ($friends as $friend)
    <div class="list">
        <!-- フレンド2の情報 -->
        <div class="fhoto"><img src="" alt="写真"></div>
        <p>{{ $friend->user2->name }}</p>
    </div>
    @endforeach
</body>
<style>
    body {
        margin: 0;
        padding: 0;
        background: linear-gradient(to top, #79C2EF 0%, #CAE5E3 100%);
        height: 900px;
    }

    .box {
        background: linear-gradient(to top, rgba(174, 210, 101, 0.5), rgba(16, 177, 199, 0.49));

    }

    .back {
        color: #fff;
        text-decoration: none;
        font-size: 30px;
        width: 600px;
        margin: 0 auto;
    }

    .list {
        width: 600px;
        margin: 0 auto;
        background-color: #fff;
        display: flex;
        border-bottom: 1px solid #79C2EF;
    }

    .list p {
        margin: 0;
        padding: 20px;
        font-size: 24px;

    }

    .list button {
        height: 30px;
        margin-left: 400px;
        margin-top: 25px;
    }
</style>

</html>