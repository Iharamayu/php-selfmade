<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class MyPageController extends Controller
{
    //
    public function showMyPage(){
        $user = auth()->user(); 
        $friendsCount = $user->list->count(); 
        return view('mypage', ['user' => $user,'friendsCount' => $friendsCount]);
    }

    public function showSettingPage(){
        $user = auth()->user(); 
        return view('setting',['user' => $user]);
    }
}
