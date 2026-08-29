<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\user;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    public function showSecurityQuestion(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        return view('auth.answer_security', [
            'email' => $user->email,
            'question' => $user->security_question
        ]);
    }

    public function verifySecurityAnswer(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'answer' => 'required|string',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }
    
        // Cek jawaban keamanan (tidak case-sensitive)
        if (strtolower($user->security_answer) !== strtolower($request->answer)) {
            return back()->with('error', 'Jawaban salah.');
        }
    
        // Reset password ke "password123"
        $newPassword = 'password123';
        $user->password = Hash::make($newPassword);
        $user->save();

        Session::flash('success', 'Password Anda telah direset ke "password123". Silakan login kembali.');
    
        return redirect()->route('password.reset.success');

    }  
    

}
