<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>更新完了</title>
</head>

<body>
    <h1 class="title">Sharediary</h1>
    <p>プロフィールを更新しました。</p>
    <img src="{{ asset('image/check_circle.png') }}" alt="check_circle">
    <a href="/mypage">マイページへ</a>
</body>
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background-color: rgba(223, 226, 234, 0.5);
        font-family: "Alef";
    }

    div {
        display: block;
    }

    .title {
        display: block;
        margin: 100px auto 20px auto;
        width: 40%;
        font-family: "Alef";
        font-size: 36px;
        color: #10B1C7;
        text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.5);
        text-align: center;
    }

    p {
        font-size: 20px;
        font-weight: bold;
        display: block;
        padding: 10px;
        width: 500px;
        margin: 0 auto;
        text-align: center;
    }

    .confirm_btn {
        margin: 10px;
    }



    img {
        display: block;
        width: 100px;
        margin: 0px auto 20px auto;
    }

    a {
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