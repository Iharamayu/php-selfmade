<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー詳細</title>
</head>

<body>
    <header>
        <div class="title">
            <a href="{{route('admin')}}"><img src="{{ asset('image/arrow_back.png') }}" alt="矢印"></a>
            &nbsp;Sharediary
        </div>
        <div class="logout"><a href="/">ログアウト</a></div>
    </header>
    <div class="container">
        <div class="phpto_frame">
            <img src="" alt="写真">
        </div>
        <div class="text">
            <p class="name">{{ $user->name }}</p>
            <p class="mail">{{ $user->email }}</p>
            <p>{{$prefecture->name}}</p>
        </div>
    </div>
    <div class="content">
        @foreach ($diaries as $diary)
        <div class="diary-entry" style="{{ 'font-size: ' . $diary->fontsize->value . '; color: ' . $diary->fontcolor->value . ';
                     background-color: ' . $diary->backgroundColor->value }}">
            <div class="diary_box">
                <div class="date_wrap">
                    <div class="date">
                        {{ \Carbon\Carbon::parse($diary->date)->format('m/d') }}
                    </div>
                </div>
                <div class="entry-details">
                    <h2 class="diary_title">{{ $diary->title }}</h2>
                    <p class="diary_content">{{ $diary->content }}</p>
                </div>
            </div>
            <div class="img">
                @foreach ($diary->images as $image)
                <img src="{{ asset('storage/' . $image->image) }}" alt="Diary Image">
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

</body>
<style>
    body {
        margin: 0;
        padding: 0;
        width: 1200px;
        height: auto;
        background-color: rgba(217, 217, 217, 0.1);
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

    .title a {
        margin: 0;
    }

    .logout {
        padding-top: 10px;
    }

    header a {
        color: #fff;
        text-decoration: none;
        font-size: 22px;
        text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.5);
        margin-right: 150px;
    }

    .back a {
        text-decoration: none;
        color: black;
    }

    .container {
        width: 60%;
        margin: 50px auto;
        display: flex;
    }

    /*日記投稿部分*/

    .content {
        width: 100%;
    }

    .diary-entry {
        width: 70%;
        margin: 0 auto;
        padding: 30px 0;

    }

    .diary_box {
        display: flex;
    }

    .date_wrap {
        width: 200px;
        margin: 0 30px 30px 30px;
    }

    .date {
        width: 130px;
        height: 130px;
        background-color: #10B1C7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 36px;
        font-family: "Alef";
        margin: 0 auto;
    }

    .entry-details {
        width: 300px;

    }

    .diary_title {
        font-size: 24px;
        display: block;
        margin-top: 10px;
    }

    .diary_content {
        font-size: 20px;
        display: block;
        margin-top: 20px;
    }

    .sharedBy {
        text-align: right;
        padding-right: 50px;
        padding-bottom: 10px;
    }

    .img {
        width: 90%;
        height: 40%;
        display: flex;
        overflow-x: scroll;
        margin: 0 auto;
    }

    .img img {
        width: 100%;
        height: 500px;
        max-width: 100%;
        max-height: 100%;
        margin-right: 5px;
        flex-shrink: 0;
        border-radius: 10px;
    }
</style>

</html>