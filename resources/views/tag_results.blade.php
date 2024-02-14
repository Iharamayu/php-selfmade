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

<body>
    <header>
        @include('layouts.header')
    </header>
    <div class="container">
        <div class="diary">
            <div class="content">
                @foreach ($diaries as $diary)
                <div class="diary-entry">
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
                    {{-- 画像がある場合のみ表示 --}}
                    @if($diary->image)
                    <img src="{{ asset('storage/images/' . $diary->image->image) }}" alt="日記の画像">
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>