<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
    <title>プロフィール変更</title>
</head>

<body>
    <div class="container">
        <h1>プロフィール</h1>
        <div class="card-body">
            <form method="POST" action="{{route('profile.confirm')}}" enctype="multipart/form-data">
                @csrf
                <div class="box">
                    <label for="name" class="">名前</label>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input id="name" type="text" name="name" placeholder="名前" value="{{ old('name') }}" autofocus>
                </div>
                <div class="box">
                    <label for="email" class="">メールアドレス</label>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input id="email" type="text" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
                </div>
                <div class="box">
                    <label for="birthdate" class="">生年月日</label>
                    @error('birthdate')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input id="birthdate" type="date" name="birthdate" placeholder="yyyy/mm/dd"
                        value="{{ old('birthdate') }}">
                </div>
                <div class="box">
                    <label for="residence_id" class="">居住地</label>
                    @error('residence_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <select id="residence_id" name="residence_id" value="{{ old('residence_id' )}}">
                        <option value="" disabled selected>選択してください</option>
                        <option value="1">北海道</option>
                        <option value="2">青森県</option>
                        <option value="3">岩手県</option>
                        <option value="4">宮城県</option>
                        <option value="5">秋田県</option>
                        <option value="6">山形県</option>
                        <option value="7">福島県</option>
                        <option value="8">茨城県</option>
                        <option value="9">栃木県</option>
                        <option value="10">群馬県</option>
                        <option value="11">埼玉県</option>
                        <option value="12">千葉県</option>
                        <option value="13">東京都</option>
                        <option value="14">神奈川県</option>
                        <option value="15">新潟県</option>
                        <option value="16">富山県</option>
                        <option value="17">石川県</option>
                        <option value="18">福井県</option>
                        <option value="19">山梨県</option>
                        <option value="20">長野県</option>
                        <option value="21">岐阜県</option>
                        <option value="22">静岡県</option>
                        <option value="23">愛知県</option>
                        <option value="24">三重県</option>
                        <option value="25">滋賀県</option>
                        <option value="26">京都府</option>
                        <option value="27">大阪府</option>
                        <option value="28">兵庫県</option>
                        <option value="29">奈良県</option>
                        <option value="30">和歌山県</option>
                        <option value="31">鳥取県</option>
                        <option value="32">島根県</option>
                        <option value="33">岡山県</option>
                        <option value="34">広島県</option>
                        <option value="35">山口県</option>
                        <option value="36">徳島県</option>
                        <option value="37">香川県</option>
                        <option value="38">愛媛県</option>
                        <option value="39">高知県</option>
                        <option value="40">福岡県</option>
                        <option value="41">佐賀県</option>
                        <option value="42">長崎県</option>
                        <option value="43">熊本県</option>
                        <option value="44">大分県</option>
                        <option value="45">宮崎県</option>
                        <option value="46">鹿児島県</option>
                        <option value="47">沖縄県</option>
                        <option value="48">その他</option>
                    </select>
                </div>
                <!--<div class="box">
                    <label for="image">プロフィール写真</label>
                    <input type="file" id="image" name="image">
                </div>-->
                <div class="btn">
                    <button class="confirm_btn" type="submit" class="">
                        確認
                    </button>
                    <a class="cancel_btn" href="{{route('setting')}}">キャンセル</a>
                </div>
</body>
<style>
    body {
        background-color: rgba(223, 226, 234, 0.5);
        width: 1200px;
    }

    h1 {
        display: block;
        width: 500px;
        margin: 0 auto;
        text-align: center;
    }

    .card-body {
        display: block;
        background-color: #fff;
        width: 500px;
        height: auto;
        padding: 30px;
        border-radius: 10px;
        margin: 20px auto;

    }

    form {
        width: 90%;
        margin: 0 auto;
    }

    .box {
        display: flex;
        margin-bottom: 30px;

    }

    label {
        display: block;
        width: 120px;
    }

    input,
    select {
        box-sizing: content-box;
        padding: 0;
        border: none;
        width: 300px;
        background-color: rgba(223, 226, 234, 0.5);
        font-size: 18px;
    }

    .btn{
        display: flex;
        flex-direction: column;
        
    }

    .confirm_btn {
        border: none;
        padding: 5px;
        width:200px;
        margin: 0 auto;
        background-color:#10B1C7 ;
        font-size: 18px;
        border-radius: 10px;
        
    }

    .cancel_btn{
        display: block;
        width: 200px;
        text-decoration: none;
        color: black;
        background-color: rgba(223, 226, 234, 0.5);
        text-align: center;
        margin: 10px auto 0 auto;
        font-size: 18px;
        padding: 5px;
        border-radius: 10px;
    }
</style>

</html>