<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct() {
        // Only allow guests
        $this->middleware(['guest']);
    }
    //
    public function index(){

        return view('auth.login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

                // sign in by attempting with the email and password from the request
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid Login details');
        }

                // redirect
        return redirect()->route('dashboard');
    }
}
