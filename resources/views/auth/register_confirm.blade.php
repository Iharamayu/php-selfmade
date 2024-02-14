<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="{{ asset('css/register_confirm.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>登録確認</title>
</head>

<body>
    <main>
        <h1 class="title">Sharediary</h1>
        <div class="register_box">
            <p>こちらの内容で登録しますか？</p>
            <form action="{{ route('register.complete') }}" method="post">
                @csrf
                <dl>
                    <dt>名前</dt>
                    <dd>
                        {{ $formData['name'] }}
                    </dd>
                    <dt>メールアドレス</dt>
                    <dd>
                        {{ $formData['email'] }}
                    </dd>
                    <dt>生年月日</dt>
                    <dd>
                        {{ $formData['birthdate'] }}
                    </dd>
                    <dt>都道府県</dt>
                    <dd>
                        {{ $formData['residence_id'] ? App\Models\Prefecture::find($formData['residence_id'])->name : ''
                        }}
                    </dd>
                    <dd class="confirm_btn">
                        <button type="submit">登録</button>
                        <a href="{{route('register')}}">戻る</a>
                    </dd>
                </dl>
            </form>
        </div>
    </main>
</body>

</html>