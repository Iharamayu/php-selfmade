<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birthdate' => ['nullable', 'date'],
            'residence_id' => ['nullable'],
        ], [
            'name.required' => 'この項目は必須です。',
            'email.required' => 'この項目は必須です。',
            'email.unique' => 'このメールアドレスは登録済みです。',
            'password.required' => 'この項目は必須です。',
            'password.min' => 'パスワードは少なくとも8文字以上である必要があります。',
            'confirmed' => 'パスワードと確認用パスワードが一致しません。',
            'birthdate.date' => '有効な日付形式を入力してください。',
        ]);
    }

    protected function confirmRegister(Request $request)
    {
        //バリデーション
        $this->validator($request->all())->validate();

        // データをセッションに保存
        $request->session()->put('formData', $request->all());

        //確認画面へデータを渡す
        return view('auth.register_confirm', ['formData' => $request->all()]);

    }




    protected function completeRegister(Request $request)
    {

        // セッションからデータを取得
        $formData = $request->session()->get('formData');

        $user = User::create([
            'name' => $formData['name'],
            'email' => $formData['email'],
            'password' => Hash::make($formData['password']),
            'birthdate' => $formData['birthdate'],
            'residence_id' => $formData['residence_id'],

        ]);

        return view('auth.register_complete');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

}
