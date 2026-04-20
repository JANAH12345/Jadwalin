<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('user.login');
    }

    public function showAdminLogin()
    {
        return view('admin.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['name' => $credentials['username'], 'password' => $credentials['password'], 'role' => 'marketing'])) {
            $request->session()->regenerate();
            return redirect()->intended(route('user.jadwal'));
        }

        return back()->with('error', 'Username atau password salah!')->withInput();
    }

    public function processAdminLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['name' => $credentials['username'], 'password' => $credentials['password'], 'role' => 'admin'])) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->with('error', 'Username atau password salah!')->withInput();
    }

    public function logout(Request $request)
    {
        // Tangkap sumber form (apakah dari admin atau user)
        $source = $request->input('source');
        
        // Simpan peran untuk opsi fallback (kalau source tidak ada misal diakses via GET langsung)
        $role = Auth::check() ? Auth::user()->role : 'guest';

        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect sesuai sumber form HTML
        if ($source === 'admin') {
            return redirect()->route('admin.login');
        } elseif ($source === 'user') {
            return redirect()->route('landing');
        }

        // Jika tidak ada source, kembali ke aturan based on role sebelum logout
        if ($role === 'admin') {
            return redirect()->route('admin.login');
        }

        return redirect()->route('landing');
    }
}
