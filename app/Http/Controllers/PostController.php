<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\Option;
use App\Models\Image;
use App\Models\User;
use App\Models\Hashtag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function showPostForm()
    {
        // ログインしているユーザーの友達情報を取得する
        $user = auth()->user();
        $friends = $user->friends;

        return view('post', ['friends' => $friends]);
    }

    public function confirmPost(Request $request)
    {
        $validatedData = $request->validate(
            [
                'date' => ['required', 'nullable', 'date'],
                'title' => ['required', 'max:60'],
                'content' => ['required']
            ],
            [
                'date.required' => '必須入力です。',
                'date.date' => '有効な日付形式を入力してください。',
                'title.required' => '必須入力です。',
                'title.max:60' => 'タイトルは６０文字以内で入力してください。',
                'content.required' => '必須入力です。'
            ]
        );

        // フォントサイズの値を取得
        $fontSizeValue = $request->input('fontsize');
        // 対応する Option レコードを取得
        $fontSizeOption = Option::where('type', 'fontsize')->where('value', $fontSizeValue)->first();
        // 対応する Option レコードが存在すれば、その ID を取得
        $fontSizeId = $fontSizeOption ? $fontSizeOption->id : null;

        // フォントカラーの値を取得
        $fontColorValue = $request->input('fontcolor');
        // 対応する Option レコードを取得
        $fontColorOption = Option::where('type', 'fontcolor')->where('value', $fontColorValue)->first();
        // 対応する Option レコードが存在すれば、その ID を取得
        $fontColorId = $fontColorOption ? $fontColorOption->id : null;

        // バックグラウンドカラーの値を取得
        $backgroundColorValue = $request->input('background');
        // 対応する Option レコードを取得
        $backgroundColorOption = Option::where('type', 'background')->where('value', $backgroundColorValue)->first();
        // 対応する Option レコードが存在すれば、その ID を取得
        $backgroundColorId = $backgroundColorOption ? $backgroundColorOption->id : null;

        $images = [];

        // フォームから送信された画像を取得し、それぞれを処理
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                // 各画像を保存し、ファイルパスを取得して配列に追加
                $filePath = $file->store('images');
                $images[] = $filePath;
            }

            // 画像のファイルパスをセッションに保存
            $request->session()->put('images', $images);
        }

        //友達情報
        $selectedFriendId = $request->input('selected_friend');
        $friendName = null;
        if ($selectedFriendId !== null) {
            // 友達の名前を取得
            $friend = User::find($selectedFriendId);

            if ($friend !== null) {
                $friendName = $friend->name;
                // セッションに友達の名前を保存
                $request->session()->put('selected_friend_name', $friendName);
            } else {
                // ユーザーが見つからない場合の処理
            }
        } else {
        }

        // バリデートされたデータから本文を取得
        $content = $validatedData['content'];
        // フォームから送信された本文からハッシュタグを抽出
        $hashtags = $this->extractHashtags($content);


        //データをセッションに保存
        $request->session()->put('validatedData', $validatedData);
        $request->session()->put('fontSizeId', $fontSizeId);
        $request->session()->put('fontColorId', $fontColorId);
        $request->session()->put('backgroundColorId', $backgroundColorId);
        $request->session()->put('hashtags', $hashtags);


        //確認ページに変数を渡す
        return view('post_confirm', [
            'validatedData' => $validatedData,
            'fontSizeValue' => $fontSizeValue,
            'fontColorValue' => $fontColorValue,
            'backgroundColorValue' => $backgroundColorValue,
            'images' => $images,
            'hashtags' => $hashtags,
            'friendName' => $friendName
        ]);

    }


    public function completePost(Request $request)
    {
        $validatedData = $request->session()->get('validatedData');
        $fontSizeId = $request->session()->get('fontSizeId');
        $fontColorId = $request->session()->get('fontColorId');
        $backgroundColorId = $request->session()->get('backgroundColorId');

        $imagePaths = $request->session()->get('images');
        $hashtags = $request->session()->get('hashtags');

        $friendName = $request->session()->get('selected_friend_name');
        $selectedFriendId = null;

        // $friendName が null でない場合のみ処理
        if ($friendName !== null) {
            // 友達の名前からIDを取得
            $selectedFriend = User::where('name', $friendName)->first();
            // 友達が見つかった場合にのみIDを取得
            if ($selectedFriend !== null) {
                $selectedFriendId = $selectedFriend->id;
            } else {
                //
            }
        }

        // Diary モデルにデータを保存
        $user = Diary::create([
            'user_id' => Auth::id(),
            'date' => $validatedData['date'],
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'fontsize_id' => $fontSizeId,
            'fontcolor_id' => $fontColorId,
            'background_id' => $backgroundColorId,
            'shared_with_friends' => $selectedFriendId
        ]);

        // Diary の ID を取得
        $diaryId = $user->id;

        // 画像を保存し、各画像に diary_id を設定
        if (is_array($imagePaths)) {
            foreach ($imagePaths as $imagePath) {
                $image = new Image([
                    'image' => $imagePath,
                    'diary_id' => $diaryId,
                ]);
                $image->save(); // Imageを保存
            }

            // diary テーブルの image_id
            $user->update(['image_id' => $image->id]);
        }


        // ハッシュタグをデータベースに保存
        foreach ($hashtags as $tag) {
            Hashtag::create([
                'tag' => $tag,
                'diary_id' => $user->id,
            ]);
        }

        // リレーションを使ってオプションを取得
        $fontSize = Option::find($user->fontsize_id);
        $fontColor = Option::find($user->fontcolor_id);
        $backgroundColor = Option::find($user->background_id);

        // それぞれのオプションにアクセス
        //dd($fontSize, $fontColor, $backgroundColor);


        return view('post_complete');
    }

    private function extractHashtags($content)
    {
        preg_match_all('/#(\w+)/', $content, $matches);
        return $matches[1];
    }

    public function searchTag(Request $request)
    {
        $tag = $request->input('tag');

        // ハッシュタグが含まれる日記を検索
        $diaries = Diary::whereHas('hashtags', function ($query) use ($tag) {
            $query->where('tag', $tag);
        })->get();

        return view('tag_results', ['diaries' => $diaries, 'tag' => $tag]);
    }

    public function showIndex()
    {
        // ログインしているか確認
        if (Auth::check()) {
            $user = Auth::user();

            // ログインユーザーに関連する日記データを取得
            $diaries = $user->diaries()->with('fontsize', 'fontcolor', 'backgroundColor')->get();
            // 日記ごとにオプションを取得し、スタイルを生成
            foreach ($diaries as $diary) {
                $fontsizeStyle[$diary->id] = 'font-size: ' . $diary->fontsize->value;
                $fontcolorStyle[$diary->id] = 'color: ' . $diary->fontcolor->value;
                $backgroundStyle[$diary->id] = 'background-color: ' . $diary->backgroundColor->value;
            }

            //dd($fontsizeStyle);
            //dd($fontcolorStyle);
            //dd($backgroundStyle);

            // index.blade.phpにデータを渡して表示
            return view('index', [
                'diaries' => $diaries,
                'fontsizeStyle' => $fontsizeStyle,
                'fontcolorStyle' => $fontcolorStyle,
                'backgroundStyle' => $backgroundStyle
            ]);
        }
    }


    public function sharedDiaries()
    {
        $friendId = auth()->user()->id; // ログインしている友達のIDを取得

        // ログインしている友達に共有された日記を取得
        $sharedDiaries = Diary::where('shared_with_friends', 'LIKE', "%$friendId%")
            ->with('fontsize', 'fontcolor', 'backgroundColor')->get();

        // 日記ごとにオプションを取得し、スタイルを生成
        $fontsizeStyle = [];
        $fontcolorStyle = [];
        $backgroundStyle = [];
        foreach ($sharedDiaries as $diary) {
            $fontsizeStyle[$diary->id] = 'font-size: ' . $diary->fontsize->value;
            $fontcolorStyle[$diary->id] = 'color: ' . $diary->fontcolor->value;
            $backgroundStyle[$diary->id] = 'background-color: ' . $diary->backgroundColor->value;
        }


        return view('shared_diaries', [
            'sharedDiaries' => $sharedDiaries,
            'fontsizeStyle' => $fontsizeStyle,
            'fontcolorStyle' => $fontcolorStyle,
            'backgroundStyle' => $backgroundStyle
        ]);
    }

}
