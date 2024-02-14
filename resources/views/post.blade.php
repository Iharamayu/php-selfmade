<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>Post</title>
</head>

<body>
    <header>
        @include('layouts.header')
    </header>
    <main>
        <div class="contact_box">
            <form action="{{route('post.confirm')}}" method="post" id="frm" enctype="multipart/form-data">
                @csrf
                <dl>
                    <dt>
                        <label for="date">日付<span class="required">*</span></label>
                    </dt>
                    @error('date')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <dd>
                        <input type="date" name="date" id="date" value="{{ old('date') }}" class="date">
                    </dd>
                    <dt>
                        <label for="title">タイトル<span class="required">*</span></label>
                    </dt>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <dd>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="diary_title">
                    </dd>
                    <h3>本文<span class="required">*</span></h3>
                    @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="option_box">
                        <select name="fontsize" id="fontsize" class="option">
                            <option value="" disabled selected>サイズ</option>
                            <option value="16px">16px</option>
                            <option value="24px">24px</option>
                            <option value="32px">32px</option>
                        </select>
                        <select name="fontcolor" id="fontcolor" class="option">
                            <option value="" disabled selected>カラー</option>
                            <!--('fontcolor', '#FFFFFF'),('fontcolor', '#000000'),('fontcolor', 'rgba(87, 63, 44, 0.9)'),-->
                            <option value="#FFFFFF">white</option>
                            <option value="#000000">black</option>
                            <option value="rgba(87, 63, 44, 0.9)">brown</option>
                        </select>
                        <select name="background" id="background" class="option">
                            <option value="" disabled selected>背景</option>
                            <!--    ('background', '#FFFFFF'),('background', 'rgba(16, 177, 199, 0.4)'),('background', 'rgba(202, 229, 211, 0.7)'),('background', '#FFCFB4')-->
                            <option value="#FFFFFF">white</option>
                            <option value="rgba(16, 177, 199, 0.4)">blue</option>
                            <option value="rgba(202, 229, 211, 0.7)">green</option>
                            <option value="#FFCFB4">orange</option>
                        </select>
                    </div>
                    <!-- 記入欄-->
                    <dd>
                        <textarea name="content" id="content" value="{{ old('content') }}" class="content"></textarea>
                    </dd>
                    <dd>
                        <input type="file" id="image" name="image[]" multiple>
                    </dd>
                    <dd>
                        <label for="selected_friend">フレンド:</label>
                        <select name="selected_friend" id="selected_friend">
                            <option value="" disabled selected>選択</option>
                            @foreach ($friends as $friend)
                            <option value="{{ $friend->id }}">{{ $friend->name }}</option>
                            @endforeach
                        </select>
                    </dd>
                    <dd>
                        <button type="submit">次へ</button>
                    </dd>
                </dl>
            </form>
        </div>
    </main>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // fontsizeのselect要素を取得
        var fontsizeSelect = document.getElementById('fontsize');
        // fontcolorのselect要素を取得
        var fontcolorSelect = document.getElementById('fontcolor');
        // backgroundのselect要素を取得
        var backgroundSelect = document.getElementById('background');
        // contentのtextarea要素を取得
        var contentTextarea = document.getElementById('content');

        // fontsizeが変更されたとき
        fontsizeSelect.addEventListener('change', function () {
            // 選択されたフォントサイズを取得
            var selectedFontSize = this.value;
            // textareaのフォントサイズを選択された値に設定
            contentTextarea.style.fontSize = selectedFontSize;
        });

        // fontcolorが変更されたとき
        fontcolorSelect.addEventListener('change', function () {
            // 選択されたフォントカラーを取得
            var selectedFontColor = this.value;
            // textareaのフォントカラーを選択された値に設定
            contentTextarea.style.color = selectedFontColor;
        });

        // backgroundが変更されたとき
        backgroundSelect.addEventListener('change', function () {
            // 選択された背景色を取得
            var selectedBackgroundColor = this.value;
            // textareaの背景色を選択された値に設定
            contentTextarea.style.backgroundColor = selectedBackgroundColor;
        });
    });
</script>

</html>