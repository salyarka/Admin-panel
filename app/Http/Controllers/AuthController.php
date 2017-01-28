<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginAdmin;

class AuthController extends Controller
{
    /**
     * [login description]
     * 
     * @param  LoginAdmin $request [description]
     * @return [type]              [description]
     */
    public function login(LoginAdmin $request)
    {
        $adminData = [
            'login'    => $request->login,
            'password' => $request->password
        ];
        if (Auth::attempt($adminData)) {
            return redirect('admin');
        }
        flash('Логин или пароль введены не верно.', 'warning');
        return view('login');
    }

    /**
     * [logout description]
     * 
     * @return [type] [description]
     */
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
