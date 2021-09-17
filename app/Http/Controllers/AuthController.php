<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return response()->view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->redirectToRoute('posts.index');
        }

        return back()->withErrors([
            'email' => 'Email or password is incorrect!',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
