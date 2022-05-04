<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class SessionsController extends Controller
{
    public function destroy() {
        auth()->logout();

        return redirect('register')->with('success', 'Logged out successfully!');
    }

    public function create() {
        return view('sessions.create');
    }

    public function store() {
        $attributes = request()->validate([
            'email' => ['required','email',Rule::exists('users','email')],
            'password' => ['required']
       ]);
       if (auth()->attempt($attributes)) {
            session()->regenerate();
            return redirect('/')->with('success', 'You have logged in successfully!');
       }
       return back()->withInput()->withErrors(['password' => 'Wrong password.']);
    }
}
