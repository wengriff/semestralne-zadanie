<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\User;


use Illuminate\Http\Request;

class AuthController extends Controller {

    // Register
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'surname' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);



        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['role']='student';
        // Create useR

        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'Welcome!');
    }

    // Logout
    public function logout(Request $request) {
        auth()->logout();

        // Invalidate user session 
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'Goodbye!');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Welcome back!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    // Show Login form
    public function login() {
        return view('auth.login');
    }

    // Show Register Form
    public function create() {
        return view('auth.register');
    }
}
