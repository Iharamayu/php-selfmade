<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use app\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    /*protected $redirectTo = '/home';*/

    public function showSettingPassword()
    {
        return view('setting_password')->with('user', \Auth::user());
    }

    /*public function updatePassword(Request $request){
        dd($request);
    }*/

    public function updatePassword(Request $request)
    {

        // バリデーション
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => '現在のパスワードを入力してください。',
            'new_password.required' => '新しいパスワードを入力してください。',
            'new_password.min' => 'パスワードは少なくとも8文字以上で指定してください。',
            'new_password.confirmed' => '確認用パスワードが一致しません。'
        ]);
        // 現在のパスワードが正しいか確認
        $currentPassword = $request->input('current_password');
        if (!Hash::check($currentPassword, Auth::user()->password)) {
            return redirect()->back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
        }

        // 新しいパスワードをハッシュ化して保存
        $newPassword = $request->input('new_password');
        $user = Auth::user();
        $user->password = Hash::make($newPassword);
        $user->save();

        // ユーザーを再ログインさせる
        Auth::login($user);

        return redirect()->route('mypage')->with('success', 'パスワードが正常に変更されました！');
    }



}
