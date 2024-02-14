<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>Sharediary</title>
</head>
<header>
    @include('layouts.header')
</header>
<body>
    <div class="container">
        <div class="profile">
            <!--<div class="phpto_frame">
                <img src="{{ asset('image/sea.jpeg') }}" alt="写真">
            </div>-->
            <div class="text">
                <p class="name">{{ $user->name }}</p>
                <p class="mail">{{ $user->email }}</p>
                <div class="friends">
                    <p class="label">friend：<span class="num">{{ $friendsCount }}</span></p>
                    <a href="{{route('list',['id' => auth()->user()->id])}}" class="list">List</a>
                </div>
            </div>
        </div>
        @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert-success">
            {{ session('error') }}
        </div>
        @endif
        <div class="grid-container">
            <a href="" class="grid-item"><img src="{{ asset('image/カレンダー.png') }}" alt="" width="35px"></a>
            <a href="{{route('search')}}" class="grid-item"><img src="{{ asset('image/友達追加アイコン.png') }}" alt=""
                    width="35px"></a>
            <a href="{{route('setting')}}" class="grid-item"><img src="{{ asset('image/歯車アイコン.png') }}" alt=""
                    width="35px"></a>
            <a href="" class="grid-item"><img src="{{ asset('image/お知らせアイコン.png') }}" alt="" width="35px"></a>
        </div>
    </div>
</body>

</html>