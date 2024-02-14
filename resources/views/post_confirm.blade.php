<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Confirm</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post.css')}}">
</head>

<body>
    <header>
        @include('layouts.header')
    </header>
    <main>
        <div class="contact_box">

            <form action="{{ route('post.complete')}}" method="post" class="frm">
                @csrf
                <p>内容を訂正する場合は戻るを押してください。</p>
                <dl class="data">
                    <dt>日付</dt>
                    <dd class="result">
                        {{ $validatedData['date'] }}
                    </dd>
                    <dt>タイトル</dt>
                    <dd class="result">
                        {{ $validatedData['title'] }}
                    </dd>
                    <dt>本文</dt>
                    <dd>
                        <div class="design" id="dynamicContent" data-font-size="{{ $fontSizeValue }}"
                            data-font-color="{{ $fontColorValue }}" data-background-color="{{ $backgroundColorValue }}"
                            style="white-space:pre-wrap;">{{ $validatedData['content'] }}
                        </div>
                    </dd>
                    <dd>
                        <div class="img-container">
                            @foreach ($images as $image)
                            <img src="{{ asset('storage/images/' . basename($image)) }}" alt="Image" class="img">
                            @endforeach
                        </div>
                    </dd>
                    <dt>フレンド</dt>
                    <dd>{{$friendName}}</dd>
                    <dd class="confirm_btn">
                        <button type="submit">投稿</button>
                        <a href="{{route('post')}}">戻る</a>
                    </dd>
                </dl>
            </form>
        </div>
    </main>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // データ属性からフォントサイズ、フォントカラー、バックグラウンドカラーを取得
        var fontSize = document.getElementById('dynamicContent').getAttribute('data-font-size');
        var fontColor = document.getElementById('dynamicContent').getAttribute('data-font-color');
        var backgroundColor = document.getElementById('dynamicContent').getAttribute('data-background-color');

        // 動的なコンテンツにスタイルを適用
        var dynamicContent = document.getElementById('dynamicContent');
        dynamicContent.style.fontSize = fontSize;
        dynamicContent.style.color = fontColor;
        dynamicContent.style.backgroundColor = backgroundColor;
    });
</script>

</html>