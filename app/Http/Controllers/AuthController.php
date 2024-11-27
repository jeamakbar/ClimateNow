<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (session()->has('user_id')) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)
                    ->where('password', md5($request->password))
                    ->first();

        if ($user) {
            $this->setUserSession($user);
            return $this->redirectBasedOnRole();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function registerForm()
    {
        if (session()->has('user_id')) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
            'theme' => 'light',
            'is_admin' => false
        ]);

        $this->setUserSession($user);
        return redirect('/')->with('success', 'Account created successfully!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }

    protected function setUserSession($user)
    {
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'is_admin' => $user->is_admin,
            'theme' => $user->theme
        ]);
    }

    protected function redirectBasedOnRole()
    {
        return session('is_admin') 
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    }
} 