<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view("backend.auth.login");
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('userid', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('build.index');
        }

        return back()->withErrors([
            'error' => 'ログインに失敗しました。',
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('backend.auth.index');
    }
}