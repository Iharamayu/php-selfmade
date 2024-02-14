<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Prefecture;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function showSettingProfile()
    {
        return view('setting_profile');
    }

    public function confirmProfile(Request $request)
    {
        // フォームデータを検証する
        $validatedData = $request->validate([
            'name' => 'nullable',
            'string|max:255',
            'email' => 'nullable',
            'email|max:255',
            'unique',
            'birthdate' => 'nullable',
            'date',
            'residence_id' => 'nullable',
            'string',
        ], [
            'email.unique' => 'このメールアドレスは登録済みです。',
            'birthdate.date' => '有効な日付形式を入力してください。',
            'residence_id.string' => '有効な文字列を入力してください。'
        ]);

        $request->session()->put('validatedData', $validatedData);

        // residence_id から県を取得
        $prefecture = Prefecture::find($validatedData['residence_id']);

        return view('setting_profile_confirm', compact('validatedData','prefecture'));
    }

    public function update(Request $request)
    {
        //セッションから取得
        $validatedData = $request->session()->get('validatedData');

        // ユーザーの存在を確認
        $user = Auth::user();


        // ユーザー情報を更新（変更がある項目のみ更新）
        $user->fill([
            'name' => $validatedData['name'] ?? $user->name,
            'email' => $validatedData['email'] ?? $user->email,
            'birthdate' => $validatedData['birthdate'] ?? $user->birthdate,
            'residence_id' => $validatedData['residence_id'] ?? $user->residence,
        ]);


        // 更新を保存
        $user->save();

        // セッションからデータを削除
        $request->session()->forget('validatedData');

        // ビューを表示
        return view('setting_profile_complete')->with('success', 'プロフィールが正常に更新されました！');

    }





    public function deleteUser(Request $request, $id)
    {
        // ログインしているユーザーのみが自分のアカウントを削除できるようにする
        if (Auth::check() && Auth::user()->id == $id) {
            // ユーザーを削除する
            Auth::user()->delete();
            return response()->json(['message' => 'アカウントが正常に削除されました。']);
        } else {
            return response()->json(['message' => 'アカウントの削除中にエラーが発生しました。']);
        }
    }

}
