<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>Sharediary</title>
</head>


<header>
    @include('layouts.header')
</header>

<body>
    <div class="container">
        <div class="search">
            <form action="{{ route('tag') }}" method="post">
                @csrf
                <input type="text" name="tag" placeholder="タグを検索する" class="search_box">
                <button type="submit" style="display: none;"></button>
            </form>
        </div>
        <div class="content">
            <a href="{{ route('shared_diaries') }}" class="share">Shared</a>
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
    </div>
    </button>
    <br>
    <br>
    <br>
    <button class="post" onclick="window.location.href='{{ route('post') }}'">
        <img src="{{ asset('image/ノートアイコン.png') }}" alt="ノート">

</body>

</html>