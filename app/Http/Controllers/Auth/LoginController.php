<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Diary;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => [
                'required',
                'string',
                'email',
            ],
            'password' => [
                'required',
                'string',

            ],
        ], [
            'email.required' => 'この項目は必須入力です。',
            'email.email' => 'emailの形式で入力してください。',
            'password.required' => 'この項目は必須入力です。',
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request); // バリデーションを実行

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // ログインしたユーザーの取得
            $user = Auth::user();
            // 現在のログインユーザーの役割を取得
            $role = $user->role;

            if ($role === 1) {

                // 現在ログインユーザーに関連する全ての日記データを取得
                $diaries = Diary::with('image')->where('user_id',$user->id)->get();

                return view('index', [
                    'diaries' => $diaries,
                ]);
            } elseif ($role === 0) {
                //管理者
                
                return redirect()->intended('/admin');
            }
        } else {
            $userExists = \App\Models\User::where('email', $credentials['email'])->exists();
            $errors = [];

            if ($userExists) {
                $errors['password'] = '入力されたパスワードは登録された内容と違います。';
            } else {
                $errors['email'] = 'このメールアドレスは登録されていません。';
            }

            return back()->withErrors($errors)->withInput($request->except('password'));
        }
    }
}
