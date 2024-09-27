<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // Handle user registration
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required',
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users'
    //         //'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     User::create([
    //         'type' => $request->type,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return redirect()->route('showLoginForm')->with('success', 'Registration successful, please login.');
    // }

    // Handle user login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show Dashboard
    public function showDashboard()
    {   
        if(Auth::check()){
            return view('dashboard');
        }else{
            return redirect()->route('showLoginForm');
        }
       
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('showLoginForm');
    }


}
