<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Diary;

class AdminController extends Controller
{
    //

    public function showAdmin()
    {
        // ユーザー一覧を取得、prefecture が存在する場合のみ取得
        $users = User::whereHas('prefecture')->with('prefecture')->get();

        // ビューにユーザー一覧を渡して表示
        return view('admin', ['users' => $users]);
    }

    public function showDetail($id)
    {
        //ユーザー情報取得
        $user = User::find($id);
        if (!$user) {
            // ユーザーが存在しない場合の処理
            return redirect()->route('error.page')->with('error', 'ユーザーが見つかりませんでした。');
        }

        // 都道府県情報取得
        $prefecture = $user->prefecture ?? '未設定';

        // ユーザーに関連する全ての日記データを取得
        $diaries = Diary::with('image')->where('user_id', $user->id)->get();

        return view('admin_detail', [
            'user' => $user,
            'diaries' => $diaries,
            'prefecture' => $prefecture
        ]);
    }

    public function deleteUser($id)
    {
        // ユーザーを削除する
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'ユーザーが正常に削除されました。']);
    }

}
