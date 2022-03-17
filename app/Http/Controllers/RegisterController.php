<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index',[
            'title' => 'register',
            'active' => 0
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'level' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // $validated['password'] = bcrypt($validated['password']);
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('/login')->with('success', 'Registrasi berhasil, silahkan login');
    }
}
