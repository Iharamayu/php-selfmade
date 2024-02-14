<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Friend;
use Illuminate\Support\Facades\DB;

class UserSearchController extends Controller
{
    //
    public function showSearchPage()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');

        // ユーザー検索（名前が一致するユーザーを取得）
        $users = User::where('name', 'like', '%' . $name . '%')->get();

        return view('search_result', ['users' => $users]);
    }

    public function showSearchResult(Request $request)
    {
        $name = $request->input('name');

        // ユーザー検索（名前が一致するユーザーを取得）
        $users = User::where('name', 'like', '%' . $name . '%')->get();

        return view('search_result', ['users' => $users]);
    }

    public function addUser(Request $request, User $user)
    {
        // ログインしているユーザーID
        $user_id1 = auth()->id();
        
        $user_id2 = $user->id;
    
        // すでに友人関係が存在するかチェック
        $existingFriendship = DB::table('friends')
            ->where('user_id1', $user_id1)
            ->where('user_id2', $user_id2)
            ->orWhere(function ($query) use ($user_id1, $user_id2) {
                $query->where('user_id1', $user_id2)
                      ->where('user_id2', $user_id1);
            })
            ->exists();
    
        // 友人関係が存在しない場合のみ追加
        if (!$existingFriendship) {
            // フレンドシップを追加
            DB::table('friends')->insert([
                'user_id1' => $user_id1,
                'user_id2' => $user_id2,
            ]);
    
            return redirect()->route('mypage')->with('success', 'フレンドが追加されました。');
        }
    
        return redirect()->route('mypage')->with('error', '追加済みです。');
    }
    



    public function friendsList($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            // ユーザーが見つからない場合の処理
            return abort(404);
        }

        $friends = $user->List; // メソッドを呼び出す

        return view('friend_list', ['friends' => $friends]);
    }
}
