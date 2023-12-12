<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function index()
    {
        return view('auth.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only('username', 'password');
        $user = User::where('username', $credentials['username'])->first();
        if($user)
        {
            if($user->status == 'inactive'){
                return redirect()->route('auth')->withErrors([
                    'username' => 'Akun ini tidak aktif',
                ]);
            }else{
                if(Auth::attempt($credentials)){
                    $request->session()->regenerate();
                    return redirect()->route('dashboard');
                }else{
                    return redirect()->route('auth')->withErrors([
                        'username' => 'The provided credentials do not match our records.',
                    ]);
                }
    
            }
        }else{
            return redirect()->route('auth')->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ]);
        }
   
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth');
    }
}
