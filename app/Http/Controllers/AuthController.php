<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginAdmin;

class AuthController extends Controller
{
    /**
     * Authentication for admins.
     * 
     * @param  LoginAdmin $request
     * @return Response
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
     * Logout for admins.
     * 
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
