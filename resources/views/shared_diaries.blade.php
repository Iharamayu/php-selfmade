<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/share.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>sharedDiaries</title>
</head>

<body>
    <header>
        @include('layouts.header')
    </header>
    <div class="content">
        @foreach ($sharedDiaries as $diary)
        @if(auth()->check() && auth()->user()->id !== $diary->user_id)
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
            <div class="sharedBy">
                <!-- 日記を共有したユーザーの名前を表示 -->
                Shared by: {{ \App\Models\User::find($diary->user_id)->name }}
            </div>
            <div class="img">
                @foreach ($diary->images as $image)
                <img src="{{ asset('storage/' . $image->image) }}" alt="Diary Image">
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </div>
</body>

</html>