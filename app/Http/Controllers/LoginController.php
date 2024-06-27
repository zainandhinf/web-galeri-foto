<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{

    public function authenticate(Request $request)
    {

        $login = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt($login)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back()->with('logerror', 'Login Failed!');
    }

    public function createaccount(Request $request)
    {

        $validatedData = $request->validate([
            'username' => 'required|max:255|unique:users',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'nama_lengkap' => 'required|max:255',
        ]);

        $validatedData['foto_profil'] = "photoprofile/default_profile.jpg";
        $validatedData['alamat'] = null;

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);

        $request->session()->flash('success', 'Registration successful');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }


}